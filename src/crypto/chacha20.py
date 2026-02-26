from typing import List
import struct
import sys
import base64

def rotation_gauche_32(valeur: int, decalage: int) -> int:
    """
    Rotation circulaire gauche sur 32 bits.
    Exemple : 0b1001 -> rotation -> 0b0011
    """
    return ((valeur << decalage) & 0xffffffff) | (valeur >> (32 - decalage))

def xor_octets(a: bytes, b: bytes) -> bytes:
    """
    XOR entre deux séquences d'octets.
    """
    return bytes(x ^ y for x, y in zip(a, b))

def quarter_round(etat: List[int], a: int, b: int, c: int, d: int) -> None:
    """
    Mélange 4 mots de l'état interne.

    Opérations utilisées :
      - addition modulo 2^32
      - XOR
      - rotations de bits

    C'est la brique élémentaire qui assure la diffusion.
    """

    etat[a] = (etat[a] + etat[b]) & 0xffffffff
    etat[d] ^= etat[a]
    etat[d] = rotation_gauche_32(etat[d], 16)

    etat[c] = (etat[c] + etat[d]) & 0xffffffff
    etat[b] ^= etat[c]
    etat[b] = rotation_gauche_32(etat[b], 12)

    etat[a] = (etat[a] + etat[b]) & 0xffffffff
    etat[d] ^= etat[a]
    etat[d] = rotation_gauche_32(etat[d], 8)

    etat[c] = (etat[c] + etat[d]) & 0xffffffff
    etat[b] ^= etat[c]
    etat[b] = rotation_gauche_32(etat[b], 7)

def double_tour(etat: List[int]) -> None:
    """
    Un double tour = 1 tour colonnes + 1 tour diagonales.
    ChaCha20 répète cela 10 fois (=> 20 tours).
    """

    # Mélange par colonnes
    quarter_round(etat, 0, 4, 8, 12)
    quarter_round(etat, 1, 5, 9, 13)
    quarter_round(etat, 2, 6, 10, 14)
    quarter_round(etat, 3, 7, 11, 15)

    # Mélange par diagonales
    quarter_round(etat, 0, 5, 10, 15)
    quarter_round(etat, 1, 6, 11, 12)
    quarter_round(etat, 2, 7, 8, 13)
    quarter_round(etat, 3, 4, 9, 14)

def bloc_chacha20(cle: bytes, nonce: bytes, compteur: int) -> bytes:
    """
    Produit 64 octets pseudo-aléatoires (un bloc de flot).

    Paramètres :
        cle      : 32 octets (256 bits)
        nonce    : 12 octets uniques
        compteur : numéro du bloc

    Retour :
        64 octets de flot de clés
    """

    if len(cle) != 32:
        raise ValueError("La clé doit contenir 32 octets")
    if len(nonce) != 12:
        raise ValueError("Le nonce doit contenir 12 octets")

    constantes = b"expand 32-byte k"

    # Construction de l'état initial (16 mots 32 bits)
    etat_initial = list(
        struct.unpack("<16I", constantes + cle + struct.pack("<I", compteur) + nonce)
    )

    etat_travail = etat_initial.copy()

    # 20 tours (10 double tours)
    for _ in range(10):
        double_tour(etat_travail)

    # Feed-forward : on additionne l'état initial
    for i in range(16):
        etat_travail[i] = (etat_travail[i] + etat_initial[i]) & 0xffffffff

    return struct.pack("<16I", *etat_travail)

def chiffrer_chacha20(
    cle: bytes,
    nonce: bytes,
    donnees: bytes,
    compteur_initial: int = 0
) -> bytes:
    """
    Chiffre OU déchiffre des données avec ChaCha20.

    Comme il s'agit d'un XOR :
        chiffrer(chiffrer(message)) = message

    Paramètres :
        cle               : 32 octets secrets
        nonce             : 12 octets uniques (NE JAMAIS réutiliser)
        donnees           : message clair ou chiffré
        compteur_initial  : valeur initiale du compteur

    Retour :
        données transformées
    """

    resultat = bytearray()
    compteur = compteur_initial

    for debut in range(0, len(donnees), 64):
        bloc = donnees[debut:debut + 64]

        flot = bloc_chacha20(cle, nonce, compteur)
        compteur += 1

        resultat.extend(xor_octets(bloc, flot[:len(bloc)]))

    return bytes(resultat)

def codage():
    argument = sys.argv[1]

    cle = bytes(range(32))
    nonce = b"123456789012"  # 12 octets
    message = argument.encode("utf-8")

    chiffre = chiffrer_chacha20(cle, nonce, message)

    return chiffre.hex()


if __name__ == "__main__":
    if len(sys.argv) != 2 :
        print("Usage: python chacha20.py <argument>")
    else:
        print(codage().strip())
        print(len(codage()))


