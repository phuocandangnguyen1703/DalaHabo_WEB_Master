<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duyệt hình ảnh từ máy chủ</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var funcNum = <?php echo $_GET['CKEditorFuncNum'].';'; ?>
            $('#image_list').on('click', 'img', function() {
                var fileUrl = $(this).attr('title');
                console.log(fileUrl);
                window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl);
                window.close();
            })
        });
    </script>
    <style type="text/css">
        ul.file-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        ul.file-list li {
            float: left;
            margin: 5px;
            border: 1px solid #ddd;
            padding: 10px;
        }
        ul.file-list img {
            display: block;
            margin: 0 auto;
        }
        ul.file-list li:hover {
            background:aliceblue;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="image_list">
        @foreach($fileNames as $file)
        <div class="thumbnail">
            <ul class="file-list">
                <li>
                    <img src="{{asset('/storage/uploads/images/'.$file)}}" alt="thumb" title="{{asset('/storage/uploads/images/'.$file)}}" width="120" height="130">
                    <br>
                    <span style="color:blue">{{$file}}</span>
                </li>
            </ul>
        </div>
        @endforeach
    </div>
</body>
</html>