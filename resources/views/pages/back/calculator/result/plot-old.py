# script.py
import matplotlib.pyplot as plt
import numpy as np
import sys

if __name__ == "__main__":
    # Access command-line arguments
    arg1 = sys.argv[1] if len(sys.argv) > 1 else None
    arg2 = sys.argv[2] if len(sys.argv) > 2 else None

    # Your script logic here
    print(f"Argument 1: {arg1}")
    print(f"Argument 2: {arg2}")

    x = np.linspace(-5, 5, 100)

    # Linspace digunakan untuk membuat satu set angka
    # dengan spasi merata dalam interval yang ditentukan.
    # Parameter yang diperlukan dalam linspace adalah start (nilai awal dari urutan),
    # dan end (nilai akhir urutan kecuali titik akhir diataur ke false).

    plt.plot(x, 2*x - 19, '-r', label='3y = 2x - 19')
    # plt.plot(3*x, 2*x - 19, '-r', label='2x - 3y = 19')

    plt.legend(loc = 'upper left')
    plt.grid()
    plt.show()

