<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Simple Url Shortener</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <h1>Simple Url Shortener</h1>
                <div class="mb-3">
                    <label for="url" class="form-label">Please input your url:</label>
                    <input type="url" class="form-control" id="url">
                </div>
                <button class="btn btn-primary" id="shorten-btn">Shorten</button>
            <div class="mb-3" id="shortened-url-result" style="display: none">
                <label for="url" class="form-label">Your shortened url is <a href="xxx" id="shortened-url-link">xxx</a></label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="xxx" id="clipboard-target">
                    <button class="btn btn-outline-secondary" type="button" id="copy-btn" data-clipboard-target="#clipboard-target"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-plus" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                            <path fill-rule="evenodd" d="M9.5 1h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3zM8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z"/>
                        </svg>Copy Shortened Url</button>
                </div>
            </div>
        </div>
    </body>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
    <script>
        $(function () {
            $("#shorten-btn").click(function() {
                $.post("/api/url", {'url': $("#url").val()}, function (data) {
                    $("#shortened-url-result").show();
                    console.log(data.sort_url);
                    $("#shortened-url-link").html(data.short_url);
                    $("#shortened-url-link").prop('href', data.short_url);
                    $("#clipboard-target").val(data.short_url);
                });
            });

            new ClipboardJS('#copy-btn');
        });
    </script>
</html>
