# gditle

gditle is an parse and render engine parses the given input styled string and render it to image. 

input string:

```
$str = '<p>p_start<block>block_info<b>bold></b></block><block>info2</block>p_end</p>';
```

**usage**



**lexer**

lexer scan the input string and get tokens from it. lexer result(*var_dump()*):

```
Array ( [0] => <p> [1] => p_start [2] => <block> [3] => block_info [4] => <b> [5] => bold> [6] => </b> [7] => </block> [8] => <block> [9] => info2 [10] => </block> [11] => p_end [12] => </p> )
```

**dom-parser**

(https://github.com/coodoing/gditle/blob/master/parser/domparser.md)

**ast-parser**

(https://github.com/coodoing/gditle/blob/master/parser/astparser.md)

**render**
