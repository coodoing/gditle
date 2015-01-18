# gditle

gditle is an parse and render engine parses the given input styled string and render it to image. 

input:

```
$str = '<p>p_start<block>block_info<b>bold></b></block><block>info2</block>p_end</p>';
```

**lexer**

scan the input and get tokens from it.

lexer result(var_dump):

```
Array ( [0] => <p> [1] => p_start [2] => <block> [3] => block_info [4] => <b> [5] => bold> [6] => </b> [7] => </block> [8] => <block> [9] => info2 [10] => </block> [11] => p_end [12] => </p> )
```

**parser**
given the input tokenmap or the input string to get the ast.

tokenmap

```
$tokenMap = array(
    '<p>',
    'p_start',
    '<block>',
    'block_info',
    '<b>',
    'bold>',
    '</b>',
    'block_end',
    '</block>',
    '<block>',
    'info2',
    '</block>',
    'p_end',
    '</p>'
    );
```

parser result:

```

string(93) "(<p>p_start(<block>block_info(<b>bold></b>)block_end</block>)(<block>info2</block>)p_end</p>)"

```

ast :

```
Array
(
    [0] => BinaryExprAST Object
        (
            [startTag:protected] => TagExprAST Object
                (
                    [tagMeta:protected] => TokenMeta Object
                        (
                            [tokenSymbol:protected] => p
                            [tokenTag:protected] => <p>
                            [tokenValue:protected] => <p>
                            [tokenGroup:protected] => 1
                            [tokenPriority:protected] => 255
                            [tokenPos:protected] => 
                        )

                    [tagRule:protected] => Rule Object
                        (
                            [fontRule:protected] => 
                            [positionRule:protected] => 
                            [listRule:protected] => 
                        )

                )

            [block:protected] => BlockExprAST Object
                (
                    [lhsVar:protected] => 
                    [binary:protected] => BinaryExprAST Object
                        (
                            [startTag:protected] => TagExprAST Object
                                (
                                    [tagMeta:protected] => TokenMeta Object
                                        (
                                            [tokenSymbol:protected] => block
                                            [tokenTag:protected] => <block>
                                            [tokenValue:protected] => <block>
                                            [tokenGroup:protected] => 1
                                            [tokenPriority:protected] => 254
                                            [tokenPos:protected] => 
                                        )

                                    [tagRule:protected] => Rule Object
                                        (
                                            [fontRule:protected] => 
                                            [positionRule:protected] => 
                                            [listRule:protected] => 
                                        )

                                )

                            [block:protected] => BlockExprAST Object
                                (
                                    [lhsVar:protected] => VariableExprAST Object
                                        (
                                            [varible:protected] => DVariable Object
                                                (
                                                    [vari:DVariable:private] => p_start
                                                    [fontRule:DVariable:private] => 
                                                )

                                        )

                                    [binary:protected] => BinaryExprAST Object
                                        (
                                            [startTag:protected] => TagExprAST Object
                                                (
                                                    [tagMeta:protected] => TokenMeta Object
                                                        (
                                                            [tokenSymbol:protected] => block
                                                            [tokenTag:protected] => <block>
                                                            [tokenValue:protected] => <block>
                                                            [tokenGroup:protected] => 1
                                                            [tokenPriority:protected] => 254
                                                            [tokenPos:protected] => 
                                                        )

                                                    [tagRule:protected] => Rule Object
                                                        (
                                                            [fontRule:protected] => 
                                                            [positionRule:protected] => 
                                                            [listRule:protected] => 
                                                        )

                                                )

                                            [block:protected] => BlockExprAST Object
                                                (
                                                    [lhsVar:protected] => VariableExprAST Object
                                                        (
                                                            [varible:protected] => DVariable Object
                                                                (
                                                                    [vari:DVariable:private] => block_info
                                                                    [fontRule:DVariable:private] => 
                                                                )

                                                        )

                                                    [binary:protected] => BinaryExprAST Object
                                                        (
                                                            [startTag:protected] => TagExprAST Object
                                                                (
                                                                    [tagMeta:protected] => TokenMeta Object
                                                                        (
                                                                            [tokenSymbol:protected] => b
                                                                            [tokenTag:protected] => <b>
                                                                            [tokenValue:protected] => <b>
                                                                            [tokenGroup:protected] => 1
                                                                            [tokenPriority:protected] => 253
                                                                            [tokenPos:protected] => 
                                                                        )

                                                                    [tagRule:protected] => Rule Object
                                                                        (
                                                                            [fontRule:protected] => 
                                                                            [positionRule:protected] => 
                                                                            [listRule:protected] => 
                                                                        )

                                                                )

                                                            [block:protected] => BlockExprAST Object
                                                                (
                                                                    [lhsVar:protected] => VariableExprAST Object
                                                                        (
                                                                            [varible:protected] => DVariable Object
                                                                                (
                                                                                    [vari:DVariable:private] => bold>
                                                                                    [fontRule:DVariable:private] => 
                                                                                )

                                                                        )

                                                                    [binary:protected] => 
                                                                    [rhsVar:protected] => 
                                                                )

                                                            [endTag:protected] => TagExprAST Object
                                                                (
                                                                    [tagMeta:protected] => TokenMeta Object
                                                                        (
                                                                            [tokenSymbol:protected] => b
                                                                            [tokenTag:protected] => </b>
                                                                            [tokenValue:protected] => </b>
                                                                            [tokenGroup:protected] => 1
                                                                            [tokenPriority:protected] => 253
                                                                            [tokenPos:protected] => 
                                                                        )

                                                                    [tagRule:protected] => 
                                                                )

                                                        )

                                                    [rhsVar:protected] => VariableExprAST Object
                                                        (
                                                            [varible:protected] => DVariable Object
                                                                (
                                                                    [vari:DVariable:private] => block_end
                                                                    [fontRule:DVariable:private] => 
                                                                )

                                                        )

                                                )

                                            [endTag:protected] => TagExprAST Object
                                                (
                                                    [tagMeta:protected] => TokenMeta Object
                                                        (
                                                            [tokenSymbol:protected] => block
                                                            [tokenTag:protected] => </block>
                                                            [tokenValue:protected] => </block>
                                                            [tokenGroup:protected] => 1
                                                            [tokenPriority:protected] => 254
                                                            [tokenPos:protected] => 
                                                        )

                                                    [tagRule:protected] => 
                                                )

                                        )

                                    [rhsVar:protected] => 
                                )

                            [endTag:protected] => TagExprAST Object
                                (
                                    [tagMeta:protected] => TokenMeta Object
                                        (
                                            [tokenSymbol:protected] => block
                                            [tokenTag:protected] => </block>
                                            [tokenValue:protected] => </block>
                                            [tokenGroup:protected] => 1
                                            [tokenPriority:protected] => 254
                                            [tokenPos:protected] => 
                                        )

                                    [tagRule:protected] => 
                                )

                        )

                    [rhsVar:protected] => VariableExprAST Object
                        (
                            [varible:protected] => DVariable Object
                                (
                                    [vari:DVariable:private] => p_end
                                    [fontRule:DVariable:private] => 
                                )

                        )

                )

            [endTag:protected] => TagExprAST Object
                (
                    [tagMeta:protected] => TokenMeta Object
                        (
                            [tokenSymbol:protected] => p
                            [tokenTag:protected] => </p>
                            [tokenValue:protected] => </p>
                            [tokenGroup:protected] => 1
                            [tokenPriority:protected] => 255
                            [tokenPos:protected] => 
                        )

                    [tagRule:protected] => 
                )

        )

)


```

