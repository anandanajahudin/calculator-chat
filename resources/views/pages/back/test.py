import matplotlib.pyplot as plt
import numpy as np

x = np.linspace(-5, 5, 100)
plt.plot(x, 2*x - 19, '-r', label='3y = 2x - 19')
plt.plot(3*x, 2*x - 19, '-r', label='2x - 3y = 19')

plt.legend(loc = 'upper left')
plt.grid()
plt.show()