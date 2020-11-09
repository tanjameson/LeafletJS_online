<?php
$ar = array('apple', 'orange', 'banana', 'strawberry');
echo json_encode($ar); // ["apple","orange","banana","strawberry"]
?>

<?php
echo json_encode($ar, JSON_FORCE_OBJECT);
// {"0":"apple","1":"orange","2":"banana","3":"strawberry"} 
?>


<script type="text/javascript">
// pass PHP variable declared above to JavaScript variable
var ar = <?php echo json_encode($ar) ?>;
console.log("this is the value", ar);
</script>


<?php
// PHP array
$books = array(
    array(
        "title" => "Professional JavaScript",
        "author" => "Nicholas C. Zakas"
    ),
    array(
        "title" => "JavaScript: The Definitive Guide",
        "author" => "David Flanagan"
    ),
    array(
        "title" => "High Performance JavaScript",
        "author" => "Nicholas C. Zakas"
    )
);
?>

<script type="text/javascript">
// pass PHP array to JavaScript 
var books = <?php echo json_encode($books, JSON_PRETTY_PRINT) ?>;

var i;
for (i = 0; i < books.length; i++) {
  console.log("This",i);
  console.log(books[i].author);
}
// output using JSON_PRETTY_PRINT
/* var books = [ // outer level array literal
    { // second level object literals
        "title": "Professional JavaScript",
        "author": "Nicholas C. Zakas"
    },
    {
        "title": "JavaScript: The Definitive Guide",
        "author": "David Flanagan"
    },
    {
        "title": "High Performance JavaScript",
        "author": "Nicholas C. Zakas"
    }
]; */

// how to access 
console.log( books[1].author ); // David Flanagan
</script>