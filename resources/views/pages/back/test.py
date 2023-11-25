import matplotlib.pyplot as plt
import numpy as np

x = np.linspace(-20, 20, 20)

# Linspace digunakan untuk membuat satu set angka
# dengan spasi merata dalam interval yang ditentukan.
# Parameter yang diperlukan dalam linspace adalah start (nilai awal dari urutan),
# dan end (nilai akhir urutan kecuali titik akhir diataur ke false).

plt.plot(x, 2*x - 19, '-r', label='3y = 2x - 19')
# plt.plot(3*x, 2*x - 19, '-r', label='2x - 3y = 19')

plt.legend(loc = 'upper left')
plt.grid()
plt.show()
