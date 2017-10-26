import matplotlib.pyplot as plt

# Query1: wet massa energie
# Information need: Op zoek naar einstein en deze wet.

# kappa_score = 0.80
# Precision_judge1 = 0.70
# Precision_judge2 = 0.77

# Query2: Kunst groep Karel Appel
# INformation need: Op zoek naar de cobra groep.

# kappa_score = 1
# Precision_judge1 = 0.88
# Precision_judge2 = 0.88

# Query3: donald geluk
# Information need: Op zoek naar geluksvogel in de donald duck verhalen (guus geluk).

# kappa_score = 0.2
# Precision_judge1 = 0.67
# Precision_judge2 = 0.65

# Query4: columbus schip
# Information need: Op zoek naar Columbus en de schepen waar hij op gevaren heeft.

# kappa_score = 0.39
# Precision_judge1 = 0.85
# Precision_judge2 = 0.80

# Query5: nederlandse clubs
# Information neec: Op zoek naar nederlandse voetbal clubs.

# kappa_score = 0.73
# Precision_judge1 = 0.72
# Precision_judge2 = 0.57

# Average Precision = 0.75

P1 = [0.70, 0.88, 0.67, 0.85, 0.72]
P2 = [0.77, 0.88, 0.65, 0.80, 0.57]
x = range(1, 6)

plt.plot(x, P1)
plt.plot(x, P2)
plt.xlabel('query')
plt.ylabel('Precision')
plt.show()

# In this graph it can clearly be seen that more specific queries like 'kunst groep Karel Appel'
# provide a better precision than more general queries like 'nederlandse clubs'