<html lang="en-US">
<head>
    <title>Simple shop | Search Task</title>
    <meta charset="utf-8">
    <link href="public/assets/css/global.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand">Shop search</a>
            <ul class="nav">
                <li class="active">
                    <a href="#">Search</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="container top">
    
    <ul class="breadcrumb">
        <li><a href="#">AWOS</a></li>
    </ul>
    
    <div class="page-header users-header">
        <h2>Search</h2>
    </div>
    
    <form action="search.php" method="get" accept-charset="utf-8" class="form-horizontal" id="search">
        <fieldset>
            <div class="control-group">
                <label for="query" class="control-label">Search</label>
                <div class="controls">
                    <input class="form-control" placeholder="Your search query" type="text" id="query" name="query" required>
                </div>
            </div>
            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Search</button>
                <button class="btn" type="reset">Reset</button>
            </div>
        </fieldset>
    </form>
    
    <table class="table table-striped table-bordered table-condensed" id="results">
        <thead>
        <tr>
            <th>Name</th>
            <th>Cost Price</th>
            <th>Image</th>
            <th>MSRP</th>
            <th>Percentage</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="5">No data for displaying</td>
        </tr>
        </tbody>
    </table>
    
    <div id="footer">
        <hr>
        <div class="inner">
            <div class="container">
                <p class="right"><a href="#">Simple shop</a></p>
            </div>
        </div>
    </div>
    <script src="public/assets/js/jquery-1.7.1.min.js"></script>
    <script src="public/assets/js/bootstrap.min.js"></script>
    <script src="public/assets/js/custom.js"></script>
</div>
</body>
</html>