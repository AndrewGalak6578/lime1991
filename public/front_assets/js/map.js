
$(() => {
	let mapsContainers = $('.map-container');
	mapsContainers.toArray().forEach((container) => {
		initMap(container.id, container.getAttribute('data-coords').replaceAll(' ', '').split(','));
	});
});

async function initMap(key, coords) {
	var latitude = 0;
	var longitude = 0;
	if (key === undefined || coords === undefined) return;
	if (coords.length < 2) coords = [0, 0];

	latitude = coords[0];
	longitude = coords[1];

	if ($('input[name=latitude]').length > 0) {
		$('input[name=latitude]').get(0).value = latitude.toString();
	}
	if ($('input[name=longitude]').length > 0) {
		$('input[name=longitude]').get(0).value = longitude.toString();
	}

	await ymaps3.ready;

	const { YMap, YMapDefaultSchemeLayer, YMapMarker, YMapDefaultFeaturesLayer } = ymaps3;

	const mapScheme = new YMapDefaultSchemeLayer({});

	const defaultFeaturesLayer = new YMapDefaultFeaturesLayer({ zIndex: 1501 });

	const markerElement = document.createElement('div');
	markerElement.className = 'marker-class';
	markerElement.innerHTML = `<img src="/front_assets/imgs/lime/icons/map_marker.png">`;

	const marker = new YMapMarker(
		{
			source: 'ymaps3x0-default-feature',
			coordinates: [coords[1], coords[0]],
			zIndex: 1502,
			mapFollowsOnDrag: true
		},
		markerElement
	);

	const map = new YMap(
		document.getElementById(`${key}`),
		{
			location: {
				center: [coords[1], coords[0]],
				zoom: 12
			},
			mode: 'vector'
		},
		[mapScheme, defaultFeaturesLayer, marker]
	);

	let updateMap = () => {
		coords = [
			latitude,
			longitude
		];
		map.setLocation({
			center: [coords[1], coords[0]],
		});
		marker.update({
			coordinates: [coords[1], coords[0]],
		});
	};

	$('input[name=latitude]').on('input', (e) => {
		let split = e.target.value.split(',');
		if (split.length == 2) {
			latitude = parseFloat(split[0]);
			longitude = parseFloat(split[1]);
			$('input[name=latitude]').get(0).value = latitude;
			$('input[name=longitude]').get(0).value = longitude
		} else {
			latitude = parseFloat(e.target.value);
		}
		updateMap();
	})
	$('input[name=longitude]').on('input', (e) => {
		let split = e.target.value.split(',');
		if (split.length == 2) {
			latitude = parseFloat(split[0]);
			longitude = parseFloat(split[1]);
			$('input[name=latitude]').get(0).value = latitude;
			$('input[name=longitude]').get(0).value = longitude
		} else {
			longitude = parseFloat(e.target.value);
		}
		updateMap();
	})

}
