<?php
require($_SERVER["DOCUMENT_ROOT"].'/local/vendor/autoload.php');

use \DiDom\Document;

?>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <div class="w-100 h-100">
        <div class="d-flex w-100 h-50 align-items-center justify-content-center">
            <form method="post">
                <div class="form-group">
                    <label for="teamName">Team</label>
                    <input type="text" class="form-control" id="teamName" name="teamName"
                          aria-describedby="teamNameHelp" placeholder="Enter team name">
                    <small id="teamNameHelp" class="form-text text-muted">We'll prefer you to type it with starting capital letter.</small>
                  </div>
                <button type="submit" class="btn btn-primary">Download</button>
            </form>
        </div>
        <div class="d-flex w-100 h-50 align-items-center justify-content-center">
<?php
if (isset($_POST['teamName']) && !empty($_POST['teamName'])){

    $name = $_POST['teamName'];

    $curYear = date('y');
    $firstYear = 9;
    $result = [];

    $document = new Document('https://terrikon.com/football/italy/championship/table', true);
    $team = $document->first('div.maincol div.tab table a:contains('.$name.')');

    if (empty($team)){
        unset($_POST);
        exit();
    }

    $result[$name] = ['20'.($curYear-1).'-'.$curYear => intval($team->parent()->parent()->child(1)->text())];
    $curYear--;

    while ($curYear > $firstYear+1)
    {
        $document = new Document('https://terrikon.com/football/italy/championship/20'.($curYear-1).'-'.$curYear.'/table', true);
        $team = $document->first('div.maincol div.tab table a:contains('.$name.')');
        $result[$name]['20'.($curYear-1).'-'.$curYear] = intval($team->parent()->parent()->child(1)->text());
        $curYear--;
    }

    $document = new Document('https://terrikon.com/football/italy/championship/200'.($curYear-1).'-'.$curYear.'/table', true);
    $team = $document->first('div.maincol div.tab table a:contains('.$name.')');
    $result[$name]['200'.($curYear-1).'-'.$curYear] = intval($team->parent()->parent()->child(1)->text());
    echo"<pre>";
    print_r($result);
    echo"</pre>";
}
?>
        </div>
    </div>
</body>
