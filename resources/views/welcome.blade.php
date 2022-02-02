<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PHP URL SHORTENER</title>

        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
        <style>
            html, body {
                display: flex;
                justify-content: center;
                font-family: Roboto, Arial, sans-serif;
                font-size: 15px;
            }
            form {
                border: 5px solid #f1f1f1;
            }
            input[type=text], input[type=password] {
                width: 100%;
                padding: 16px 8px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                box-sizing: border-box;
            }
            /*.icon {*/
            /*    font-size: 110px;*/
            /*    display: flex;*/
            /*    justify-content: center;*/
            /*    color: #4286f4;*/
            /*}*/
            button {
                background-color: #4286f4;
                color: white;
                padding: 14px 0;
                margin: 10px 0;
                border: none;
                cursor: grab;
                width: 48%;
            }
            h1 {
                text-align:center;
                fone-size:18;
            }
            button:hover {
                opacity: 0.8;
            }
            .formcontainer {
                text-align: center;
                margin: 24px 50px 12px;
            }
            .container {
                padding: 16px 0;
                text-align:left;
            }
            span.psw {
                float: right;
                padding-top: 0;
                padding-right: 15px;
            }
            /* Change styles for span on extra small screens */
            @media screen and (max-width: 300px) {
                span.psw {
                    display: block;
                    float: none;
                }
            }


            .input_copy {
                padding: 15px 25px;
                background: #eee;
                border: 2px solid #aaa;
                color: #aaa;
                font-size: .8em;
            }

            .input_copy .icon {
                display: block;
                max-width: 25px;
                cursor: pointer;
                float: right;
            }

            .input_copy .icon img{
                max-width: 25px;
            }
            .input_copy .txt {
                width: 80%;
                display: inline-block;
                overflow: hidden;
            }


            /* click animation */

            .flashBG {
                animation-name: flash;
                animation-timing-function: ease-out;
                animation-duration: 1s;
            }

            @keyframes flash {
                0% {
                    background: #28a745;
                }
                100% {
                    background: transparent;
                }
            }
        </style>
    </head>
    <body>
    <form id="url_shortener_form">
        @csrf
        <h1>PHP URL shortener</h1>
        <div class="formcontainer">
            <div class="container">
                <label for="url_link"><strong>URL link</strong></label>
                <input type="text" placeholder="Enter URL link" name="url_link" id="url_link" required>
            </div>
            <button type="submit"><strong>Shorten link</strong></button>

            <div class="container url_result" style="visibility: hidden">
                  <div class="input_copy_wrapper">
                    <div class="input_copy">
                        <span class="txt"></span>
                        <span class="icon right"><img src="http://clipground.com/images/copy-4.png" title="Click to Copy"></span>
                    </div>
                </div>
            </div>


        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script>
        $('#url_shortener_form').on('submit',function(event){
            event.preventDefault();
            let url_link = $('#url_link').val();

            $.ajax({
                url: "/api/shorten-url",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    url_link: url_link,
                },
                success:function(response){
                    $(".url_result").css("visibility", "visible");
                    $('.input_copy .txt').text(response.data.url);
                },
            });
        });
    </script>

    <script>

        function copyToClipboard(element) {
            let $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
        }

        let addrsField = $('.input_copy .txt');
        $('.input_copy .icon').click(function() {
            copyToClipboard('.input_copy .txt');
            addrsField.addClass('flashBG')
                .delay('1000').queue(function(){
                addrsField.removeClass('flashBG').dequeue();
            });
        });
    </script>
    </body>
</html>
