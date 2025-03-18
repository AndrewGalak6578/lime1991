<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
    <link href="/admin_assets/css/style.css" rel="stylesheet">
	</head>
	<body style="background: white;">
		<style>
			.card-body {
				display: flex;
				flex-direction: column;
				justify-content: flex-start;
				align-items: flex-start;
				gap: 10px;
			}
			progress {
				width: 200px;
			}
		</style>
		@if ($progress == null || $isComplete)
			<script>
				setTimeout(() => {
					window.parent.location.href = 'https://lime1991.ru/admin/parser';
				}, 2000);
			</script>
		@else
			<div class="card-body">
				<meta http-equiv="refresh" content="5">
				<!-- <progress max="100" value=""></progress> -->
				<progress></progress>
				<h5>Прошло: {{$time}}</h5>
				@foreach ($progress as $item)
					<h5>{{$item[0]}}... ({{$item[1]}}/{{$item[2]}})</h5>
				@endforeach
			</div>
		@endif
	</body>
</html>
