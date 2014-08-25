#include <stdio.h>
#include <stdlib.h>
#include <ctype.h>
#include <string.h>

#define MAX_BRANCH 128
#define MAX_WORD_LENGTH 128

struct _struct_trie_tree
{
    char char_;
    int count;
    struct _struct_trie_tree **children;
};

typedef struct _struct_trie_tree TrieTree;

void init_node(TrieTree *tree, char c)
{
    tree->char_ = c;
    tree->count = 0;
    tree->children = NULL;
}

TrieTree * create_node(char c)
{
    TrieTree *tree = (TrieTree*) malloc(sizeof(TrieTree));
    init_node(tree, c);
    return tree;
}

TrieTree * init_tree()
{
    return create_node(0);
}

TrieTree * add_node(TrieTree * node, char c)
{
    if (node->children == NULL) {
        node->children = (TrieTree **)malloc(sizeof(TrieTree *) * MAX_BRANCH);
        memset(node->children, 0, sizeof(TrieTree *) * MAX_BRANCH);
    }
    for (int i = 0; i < MAX_BRANCH; ++i)
    {
        if (node->children[i] == NULL) {
            node->children[i] = create_node(c);
            return node->children[i];
        } else if (node->children[i]->char_ == c) {
            return node->children[i];
        }
    }
    // will not reach here
}

int add_word(TrieTree * tree, char * word)
{
    printf("add %s\n", word);
    TrieTree * node;
    node = tree;
    while ((*word) != 0 && !isspace(*word)) {
        node = add_node(node, *word);
        word++;
    }
    node->count++;
    return node->count;
}

void word_iter(TrieTree *tree, char * cp)
{

}
void branch_iter(TrieTree *tree, FILE * out, char *word, char * cp)
{
    if (tree->children == NULL) {
        return;
    }
    *cp = tree->char_;
    printf("iter %c\n", tree->char_);
    if (tree->count > 0) {
        printf("put %s\n", word);
        char buf[MAX_WORD_LENGTH + 10];
        sprintf(buf, "%s %d", word, tree->count);
        fputs(buf, out);
    }
    int i = 0;
    while (tree->children[i] != NULL) {
        branch_iter(tree->children[i], out, word, cp+1);
        i++;
    }
}
int put_tree(TrieTree *tree, FILE * out)
{
    char word[MAX_WORD_LENGTH];
    memset(word, 0, MAX_WORD_LENGTH);
    branch_iter(tree, out, word, word);
}

int main(int argc, char const *argv[])
{
    TrieTree *tree;
    tree = init_tree();

    FILE * in;
    char line[MAX_WORD_LENGTH];
    in = fopen("in.txt", "r");
    while (fgets(line, MAX_WORD_LENGTH, in)) {
        add_word(tree, line);
    }
    fclose(in);

    FILE *out;
    out = fopen("out.txt", "w");
    put_tree(tree, out);
    fclose(out);
    return 0;
}
