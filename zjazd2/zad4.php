<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Is prime number</title>
</head>

<body>
    <form>
        <input name="a" type="number" step="1" min="1" required>
        <input type="submit">
    </form>
    <br><br>
    <?php
    class Prime
    {
        private $isPrime = false;
        private $count = 0;
        private $divider = 0;
        public function setDate($isPrime, $count, $divider)
        {
            $this->isPrime = $isPrime;
            $this->count = $count;
            $this->divider = $divider;
        }
        public function isPrimeNumber($a)
        {
            $count = 0;
            if (in_array($a, array(0, 1))) return false;
            for ($i = 2; $i <= sqrt($a); $i++) {
                $count++;
                if ($a % $i == 0) {
                    $this->setDate(false, $count, $i);
                    return false;
                }
            }
            $this->setDate(true, $count, 0);
            return true;
        }
        public function description()
        {
            if ($this->isPrime) {
                return "Prime number,<br> the number of turns of the loop: $this->count";
            } else {
                return "Not a prime number,<br> the number of turns of the loop: $this->count,<br> first divisor: $this->divider";
            }
        }
    }
    if (isset($_GET['a'])) {
        $a = is_numeric($_GET['a']) && $_GET['a'] > 0 && (int)$_GET['a'] == $_GET['a'] ? $_GET['a'] : null;
        if ($a != null) {
            $prime = new Prime();
            $prime->isPrimeNumber($a);
            echo $prime->description();
        } else {
            echo "ERROR";
        }
    }
    ?>
</body>

</html>