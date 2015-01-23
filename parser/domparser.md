**domparser**

domparser use the tidy extentsion to parse the string to dom structure and extend the tidyNode to **ExtendTidyNode** object which also contains the level, md5hash, rule attributes, etc.

[tidy](http://php.net/manual/en/book.tidy.php) is a binding for the Tidy HTML clean and repair utility which allows you to not only clean and otherwise manipulate HTML documents, but also traverse the document tree. But it can only parse html tags. 

input string:

```
<p class="blanket" id="pid">start<span lang="en">en</span><span country="uk">uk</span>end</p>
```

## usage

```

$parser = new DOMParser($str);
$parser->find('span');
$parser->find('p#pid');
$parser->find('p.blanket');
$parser->find('span[lang=en]');

```

## ExtendTidyNode structure

```

    protected $rule;

    protected $node; //tidyNode

    protected $level;

    protected $md5Hash;

    protected $type;

```

## dom 


```
Array
(
    [854d00231512463e080bb175098e9aa1] => ExtendTidyNode Object
        (
            [rule:protected] => Rule Object
                (
                    [fontRule:protected] => 
                    [positionRule:protected] => 
                    [listRule:protected] => 
                )

            [node:protected] => tidyNode Object
                (
                    [value] => <body>
<p class="blanket" id="pid">start<span lang=
"en">en</span><span country="uk">uk</span>end</p>
</body>

                    [name] => body
                    [type] => 5
                    [line] => 1
                    [column] => 1
                    [proprietary] => 
                    [id] => 16
                    [attribute] => 
                    [child] => Array
                        (
                            [0] => tidyNode Object
                                (
                                    [value] => <p class="blanket" id="pid">start<span lang=
"en">en</span><span country="uk">uk</span>end</p>

                                    [name] => p
                                    [type] => 5
                                    [line] => 1
                                    [column] => 1
                                    [proprietary] => 
                                    [id] => 79
                                    [attribute] => Array
                                        (
                                            [class] => blanket
                                            [id] => pid
                                        )

                                    [child] => Array
                                        (
                                            [0] => tidyNode Object
                                                (
                                                    [value] => start
                                                    [name] => 
                                                    [type] => 4
                                                    [line] => 1
                                                    [column] => 29
                                                    [proprietary] => 
                                                    [attribute] => 
                                                    [child] => 
                                                )

                                            [1] => tidyNode Object
                                                (
                                                    [value] => <span lang="en">en</span>
                                                    [name] => span
                                                    [type] => 5
                                                    [line] => 1
                                                    [column] => 34
                                                    [proprietary] => 
                                                    [id] => 98
                                                    [attribute] => Array
                                                        (
                                                            [lang] => en
                                                        )

                                                    [child] => Array
                                                        (
                                                            [0] => tidyNode Object
                                                                (
                                                                    [value] => en
                                                                    [name] => 
                                                                    [type] => 4
                                                                    [line] => 1
                                                                    [column] => 50
                                                                    [proprietary] => 
                                                                    [attribute] => 
                                                                    [child] => 
                                                                )

                                                        )

                                                )

                                            [2] => tidyNode Object
                                                (
                                                    [value] => <span country="uk">uk</span>
                                                    [name] => span
                                                    [type] => 5
                                                    [line] => 1
                                                    [column] => 59
                                                    [proprietary] => 
                                                    [id] => 98
                                                    [attribute] => Array
                                                        (
                                                            [country] => uk
                                                        )

                                                    [child] => Array
                                                        (
                                                            [0] => tidyNode Object
                                                                (
                                                                    [value] => uk
                                                                    [name] => 
                                                                    [type] => 4
                                                                    [line] => 1
                                                                    [column] => 78
                                                                    [proprietary] => 
                                                                    [attribute] => 
                                                                    [child] => 
                                                                )

                                                        )

                                                )

                                            [3] => tidyNode Object
                                                (
                                                    [value] => end
                                                    [name] => 
                                                    [type] => 4
                                                    [line] => 1
                                                    [column] => 87
                                                    [proprietary] => 
                                                    [attribute] => 
                                                    [child] => 
                                                )

                                        )

                                )

                        )

                )

            [level:protected] => 1
            [md5Hash:protected] => 854d00231512463e080bb175098e9aa1
            [type:protected] => 5
        )

    [5d1db4ca9ff8fe3f19eb4405c2e45f27] => ExtendTidyNode Object
        (
            [rule:protected] => Rule Object
                (
                    [fontRule:protected] => 
                    [positionRule:protected] => 
                    [listRule:protected] => 
                )

            [node:protected] => tidyNode Object
                (
                    [value] => <p class="blanket" id="pid">start<span lang=
"en">en</span><span country="uk">uk</span>end</p>

                    [name] => p
                    [type] => 5
                    [line] => 1
                    [column] => 1
                    [proprietary] => 
                    [id] => 79
                    [attribute] => Array
                        (
                            [class] => blanket
                            [id] => pid
                        )

                    [child] => Array
                        (
                            [0] => tidyNode Object
                                (
                                    [value] => start
                                    [name] => 
                                    [type] => 4
                                    [line] => 1
                                    [column] => 29
                                    [proprietary] => 
                                    [attribute] => 
                                    [child] => 
                                )

                            [1] => tidyNode Object
                                (
                                    [value] => <span lang="en">en</span>
                                    [name] => span
                                    [type] => 5
                                    [line] => 1
                                    [column] => 34
                                    [proprietary] => 
                                    [id] => 98
                                    [attribute] => Array
                                        (
                                            [lang] => en
                                        )

                                    [child] => Array
                                        (
                                            [0] => tidyNode Object
                                                (
                                                    [value] => en
                                                    [name] => 
                                                    [type] => 4
                                                    [line] => 1
                                                    [column] => 50
                                                    [proprietary] => 
                                                    [attribute] => 
                                                    [child] => 
                                                )

                                        )

                                )

                            [2] => tidyNode Object
                                (
                                    [value] => <span country="uk">uk</span>
                                    [name] => span
                                    [type] => 5
                                    [line] => 1
                                    [column] => 59
                                    [proprietary] => 
                                    [id] => 98
                                    [attribute] => Array
                                        (
                                            [country] => uk
                                        )

                                    [child] => Array
                                        (
                                            [0] => tidyNode Object
                                                (
                                                    [value] => uk
                                                    [name] => 
                                                    [type] => 4
                                                    [line] => 1
                                                    [column] => 78
                                                    [proprietary] => 
                                                    [attribute] => 
                                                    [child] => 
                                                )

                                        )

                                )

                            [3] => tidyNode Object
                                (
                                    [value] => end
                                    [name] => 
                                    [type] => 4
                                    [line] => 1
                                    [column] => 87
                                    [proprietary] => 
                                    [attribute] => 
                                    [child] => 
                                )

                        )

                )

            [level:protected] => 2
            [md5Hash:protected] => 5d1db4ca9ff8fe3f19eb4405c2e45f27
            [type:protected] => 5
        )

    [b3e1ea4a8656f84e3c51dec39bc6575b] => ExtendTidyNode Object
        (
            [rule:protected] => Rule Object
                (
                    [fontRule:protected] => 
                    [positionRule:protected] => 
                    [listRule:protected] => 
                )

            [node:protected] => tidyNode Object
                (
                    [value] => start
                    [name] => 
                    [type] => 4
                    [line] => 1
                    [column] => 29
                    [proprietary] => 
                    [attribute] => 
                    [child] => 
                )

            [level:protected] => 3
            [md5Hash:protected] => b3e1ea4a8656f84e3c51dec39bc6575b
            [type:protected] => 4
        )

    [56db2507c5f3b7447b398e22a0620106] => ExtendTidyNode Object
        (
            [rule:protected] => Rule Object
                (
                    [fontRule:protected] => 
                    [positionRule:protected] => 
                    [listRule:protected] => 
                )

            [node:protected] => tidyNode Object
                (
                    [value] => <span lang="en">en</span>
                    [name] => span
                    [type] => 5
                    [line] => 1
                    [column] => 34
                    [proprietary] => 
                    [id] => 98
                    [attribute] => Array
                        (
                            [lang] => en
                        )

                    [child] => Array
                        (
                            [0] => tidyNode Object
                                (
                                    [value] => en
                                    [name] => 
                                    [type] => 4
                                    [line] => 1
                                    [column] => 50
                                    [proprietary] => 
                                    [attribute] => 
                                    [child] => 
                                )

                        )

                )

            [level:protected] => 3
            [md5Hash:protected] => 56db2507c5f3b7447b398e22a0620106
            [type:protected] => 5
        )

    [8af7d48168fee87c11b85fe021e2b536] => ExtendTidyNode Object
        (
            [rule:protected] => Rule Object
                (
                    [fontRule:protected] => 
                    [positionRule:protected] => 
                    [listRule:protected] => 
                )

            [node:protected] => tidyNode Object
                (
                    [value] => <span country="uk">uk</span>
                    [name] => span
                    [type] => 5
                    [line] => 1
                    [column] => 59
                    [proprietary] => 
                    [id] => 98
                    [attribute] => Array
                        (
                            [country] => uk
                        )

                    [child] => Array
                        (
                            [0] => tidyNode Object
                                (
                                    [value] => uk
                                    [name] => 
                                    [type] => 4
                                    [line] => 1
                                    [column] => 78
                                    [proprietary] => 
                                    [attribute] => 
                                    [child] => 
                                )

                        )

                )

            [level:protected] => 3
            [md5Hash:protected] => 8af7d48168fee87c11b85fe021e2b536
            [type:protected] => 5
        )

    [57c8b426f9f7d9940de5d2f4211c4880] => ExtendTidyNode Object
        (
            [rule:protected] => Rule Object
                (
                    [fontRule:protected] => 
                    [positionRule:protected] => 
                    [listRule:protected] => 
                )

            [node:protected] => tidyNode Object
                (
                    [value] => end
                    [name] => 
                    [type] => 4
                    [line] => 1
                    [column] => 87
                    [proprietary] => 
                    [attribute] => 
                    [child] => 
                )

            [level:protected] => 3
            [md5Hash:protected] => 57c8b426f9f7d9940de5d2f4211c4880
            [type:protected] => 4
        )

    [fcb74f9454635f263e86ddb3a64ebacb] => ExtendTidyNode Object
        (
            [rule:protected] => Rule Object
                (
                    [fontRule:protected] => 
                    [positionRule:protected] => 
                    [listRule:protected] => 
                )

            [node:protected] => tidyNode Object
                (
                    [value] => en
                    [name] => 
                    [type] => 4
                    [line] => 1
                    [column] => 50
                    [proprietary] => 
                    [attribute] => 
                    [child] => 
                )

            [level:protected] => 4
            [md5Hash:protected] => fcb74f9454635f263e86ddb3a64ebacb
            [type:protected] => 4
        )

    [036f19b7fb5be646d7d6fda332dc376d] => ExtendTidyNode Object
        (
            [rule:protected] => Rule Object
                (
                    [fontRule:protected] => 
                    [positionRule:protected] => 
                    [listRule:protected] => 
                )

            [node:protected] => tidyNode Object
                (
                    [value] => uk
                    [name] => 
                    [type] => 4
                    [line] => 1
                    [column] => 78
                    [proprietary] => 
                    [attribute] => 
                    [child] => 
                )

            [level:protected] => 4
            [md5Hash:protected] => 036f19b7fb5be646d7d6fda332dc376d
            [type:protected] => 4
        )

)
```

## 

