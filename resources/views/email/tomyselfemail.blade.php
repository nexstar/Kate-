<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
</head>
<body>
    <div>
        <h4 style="margin: 0;">發送順序</h4>
        <div style="margin: 10px;">
			@for($i=0; $i<count($phones); $i++)
                <span style="margin: 10px;width: 25%;">{{$i+1}}. {{ $names[$i] }} ( {{ $phones[$i] }} )</span>
            @endfor
        </div>
    </div>
    <div>
        <h4 style="margin: 0;">發送內容</h4>
        <div style="margin:10px;">
			<p style="margin: 0px;text-align: justify;">{{ $content }}</p>
        </div>
    </div>
</body>
</html>


