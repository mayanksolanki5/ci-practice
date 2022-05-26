<!DOCTYPE html>
<html>
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title>Create PDF from View in CodeIgniter Example</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
</head>
<body>
<h1 class="text-center bg-info">Generate PDF from View using DomPDF</h1>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Article Title</th>
            <th>Article Body</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($articles as $article): ?>
            <tr>
                <td><?php echo $article->article_title; ?></td>
                <td><?php echo $article->article_body; ?></td>
            </tr>
        <?php endforeach; ?>
    <tbody>
</table>
</body>
</html>