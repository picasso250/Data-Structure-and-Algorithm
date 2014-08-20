def qsort(l):
    if len(l) <= 1:
        return l
    else:
        pivot = l[0]
        left = qsort([x for x in l if x < pivot])
        right = qsort([x for x in l if x >pivot])
        return left+[pivot]+right

#print(qsort([3,2,1]))
