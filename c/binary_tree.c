#include <stdio.h>

struct node
{
    struct node * left;
    struct node * right;
    int data;
};

typedef struct node * Tree;

int search_tree_insert(Tree *t, struct node * n)
{
    if (*t == NULL) {
        *t = n;
        return 0;
    }
    Tree cur = *t;
    while (cur) {
        if (cur->data < n->data) {
            // move left
            if (cur->left) {
                cur = cur->left;
            } else {
                cur->left = n;
                break;
            }
        } else {
            // move right
            if (cur->right) {
                cur = cur->right;
            } else {
                cur->right = n;
                break;
            }
        }
    }
    return 0;
}

int search_tree_print_padding_lenth(int i, int h)
{
    if (i == 0) {
        return 0;
    }
    return search_tree_print_padding_lenth(i-1, h) * 2 + 1;
}
int search_tree_print_padding(int i, int h)
{
    int len = search_tree_print_padding_lenth(h-1-i, h);
    for (i = 0; i < len; ++i)
    {
        printf(" ");
    }
    return len;
}

int binary_tree_ldr_walk(Tree t)
{
    printf("%d", t->data);
    if (t->left) {
        printf("(");binary_tree_ldr_walk(t->left);printf(")");
    }
    if (t->right) {
        printf("(");
        binary_tree_ldr_walk(t->right);
        printf(")");
    }
}

int binary_tree_print_data(int data)
{
    printf("%d", data);
}
int binary_tree_print(Tree t)
{
    binary_tree_ldr_walk(t);
    printf("\n");
}

int search_tree_print_level(Tree t, int level)
{
    search_tree_print_level(t, level-1);

}

int main(int argc, char const *argv[])
{
    Tree tree;
    struct node n;
    n.data = 3;
    search_tree_insert(&tree, &n);
    binary_tree_print(tree);
    return 0;
}
