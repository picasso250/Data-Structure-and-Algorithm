
def left_son_of(i, n):
    son = i*2+1
    return son if son < n else -1

def right_son_of(i, n):
    son = i*2 + 2
    return son if son < n else -1
    
def shift_down(l, i, n):
    # n will not be reachable
    print('shift_down',i,n)
    mid = int(n/2)
    while i <= mid and i >= 0:
        ls = left_son_of(i, n)
        rs = right_son_of(i, n)
        #print('ls',ls,'rs',rs,'for',i)
        if ls == -1:
            break;
        if rs == -1:
            if l[i] < l[ls]:
                l[i], l[ls] = l[ls], l[i]
            break

        if l[i] > l[ls] and l[i] > l[rs]:
            break

        if l[ls] > l[rs]:
            #print('wap i ls')
            l[i], l[ls] = l[ls], l[i]
            i = ls
        else:
            #print('swap i rs')
            l[i], l[rs] = l[rs], l[i]
            i = rs
    return l

def build_heap(l):
    n = len(l)
    i = int(n/2)
    while i >= 0:
        l = shift_down(l, i, n)
        i -= 1
    return l
def heap_sort(l):
    l = build_heap(l)
    print('after build',l)
    n = len(l)
    while n > 0:
        l[0], l[n-1] = l[n-1], l[0]
        print('after take',l)
        n -= 1
        l = shift_down(l, 0, n)
        print('after shift_down', l)
    return l

print(heap_sort([3, 2, 1, 4, 5, 6, 7, 42]))
