<?php
$plainText = "Joe";

function enctrypt($plainText, $k)
{
    $letters = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

    $placement = str_split(strtoupper(str_replace(" ", '', $plainText)));
    $word = array();
    for ($i = 0; $i < count($placement); $i++) {

        $key = array_search($placement[$i], $letters);

        $a = $k + $key;
        if ($a > 25) {
            $a = $a % 26;
            array_push($word, $letters[$a]);
        } else {
            array_push($word, $letters[$a]);
        }
        $cipherText = implode($word);
    }
    return $cipherText;
}


function bruteDecypher($cypherText)
{
    $letters = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
    $cypherPlacement = str_split(strtoupper(str_replace(" ", '', $cypherText)));
    $wordIndex = array();
    for ($i = 0; $i < count($cypherPlacement); $i++) {
        $index = array_search($cypherPlacement[$i], $letters);
        array_push($wordIndex, $index);
    }
    for ($a = 1; $a < 26; $a++) {
        echo "Key = " . $a . " --> ";
        $bruteWord = array();
        for ($z = 0; $z < count($wordIndex); $z++) {
            $indexNumber = $wordIndex[$z];
            $newIndex = $indexNumber - $a;
            if ($newIndex < 0) {
                $newIndex = $newIndex + 26;
                array_push($bruteWord, $letters[$newIndex]);
            } else {
                array_push($bruteWord, $letters[$newIndex]);
            }
        }
        echo implode($bruteWord) . "<br>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        * {
            font-family: Raleway;
        }

        .card {
            padding: 20px;
            width: 40%;
        }

        .row {
            display: flex;
            justify-content: space-evenly;
        }

        .results {
            margin-top: 30px;
        }
        .results hr{
            width: 80%;
        }
        footer {
            width: 100%;
            height: 2.5rem;
        }
        .ads, .ads:hover{
            text-decoration: none;
            color: inherit;
        }
        footer * {
            font-family: Lato;
        }
    </style>
    <script data-ad-client="ca-pub-6542984702367270" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <title>Cypha!</title>
</head>

<body>
    <br>
    <div class="container">
        <div class="jumbotron">
            <h1>Welcome to Cypha!</h1>
        </div>
        <div class="row">
            <div class="card">
                <form method="post">
                    <h4>Encrypt</h4>
                    <hr>
                    <div class="form-group">
                        <label>Text to Encrypt</label>
                        <input type="text" class="form-control" name="encrypt">
                        <label>Encryption Key</label>
                        <input type="number" class="form-control" name="key">
                    </div>
                    <button type="submit" name="go_encrypt" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <div class="card">
                <form method="post">
                    <h4>Brute Decrypt</h4>
                    <hr>
                    <div class="form-group">
                        <label>Text to Find Key For</label>
                        <input type="text" class="form-control" name="decrypt">
                    </div>
                    <button type="submit" name="go_decrypt" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
        <a class="ads" href="http://graizoah.com/afu.php?zoneid=3345088" target="_blank" rel="noopener noreferrer">
        <?php
        $errors = array();

        if (isset($_POST['go_encrypt'])) {
            if (!$_POST['encrypt'] | !$_POST['key']) {
                array_push($errors, "All fields required 😐");
            } else {
                echo "<div class='results'><center>
                    <h3>Output</h3><hr>";
                echo "<h4>" . enctrypt($_POST['encrypt'], $_POST['key']) . "</h4>";
                echo "</center></div>";
            }
        }

        if (isset($_POST['go_decrypt'])) {
            if (!$_POST['decrypt']) {
                array_push($errors, "All fields required 😐");
            } else {
                echo "<div class='results'><center>
                    <h3>Output</h3><hr>";
                bruteDecypher($_POST['decrypt']);
                echo "</center></div>";
            }
        }
        ?>
        </a>
    </div>
    </div>
    <hr>
    <footer class="footer">
        <center>By <a href="https://twitter.com/JoeEverest165">@JoeEverest165</a> <?php echo date("Y"); ?></center>
    </footer>
</body>

</html>