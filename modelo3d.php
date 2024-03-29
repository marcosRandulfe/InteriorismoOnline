<!DOCTYPE html>
<html lang="es">
    <head>
        <title>three.js webgl - loaders - OBJ loader</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
        <script src="./three/build/three.js"></script>
    </head> 
<body>
    <script type="module">
<?php

    $ruta="./OBJ/Desk.obj";
    if(isset($_POST['ruta']) && $_POST['ruta']!=""){
        $ruta=$_POST['ruta'];
    }
    echo 'var ruta ="'.$ruta.'";'
?>
			import * as THREE from './three/build/three.module.js';

			import { OBJLoader } from './OBJLoader.js';

			var container;

			var camera, scene, renderer;

			var mouseX = 0, mouseY = 0;

			var windowHalfX = window.innerWidth / 2;
			var windowHalfY = window.innerHeight / 2;

			var object;

			init();
			animate();

			function init() {

				container = document.createElement( 'div' );
				document.body.appendChild( container );

				camera = new THREE.PerspectiveCamera( 45, window.innerWidth / window.innerHeight, 1, 2000 );
				camera.position.z = 250;

				// scene

				scene = new THREE.Scene();

				var ambientLight = new THREE.AmbientLight( 0xcccccc, 0.4 );
				scene.add( ambientLight );

				var pointLight = new THREE.PointLight( 0xffffff, 0.8 );
				camera.add( pointLight );
				scene.add( camera );

				// manager

				function loadModel() {

					object.traverse( function ( child ) {

						if ( child.isMesh ) child.material.map = texture;

					} );

					object.position.y = - 95;
					object.scale.multiplyScalar(100);
				        console.log(object);
					scene.add( object );

				}

				var manager = new THREE.LoadingManager( loadModel );

				manager.onProgress = function ( item, loaded, total ) {

					console.log( item, loaded, total );

				};

				// texture

				var textureLoader = new THREE.TextureLoader( manager );

				var texture = textureLoader.load( './textura_madera.jpg' );

				// model

				function onProgress( xhr ) {

					if ( xhr.lengthComputable ) {

						var percentComplete = xhr.loaded / xhr.total * 100;
						console.log( 'model ' + Math.round( percentComplete, 2 ) + '% downloaded' );

					}

				}

				function onError() {}

				var loader = new OBJLoader( manager );

				loader.load( ruta, function ( obj ) {
				        object = obj;
				}, onProgress, onError );

				renderer = new THREE.WebGLRenderer();
				renderer.setPixelRatio( window.devicePixelRatio );
				renderer.setSize( window.innerWidth, window.innerHeight );
				container.appendChild( renderer.domElement );

				document.addEventListener( 'mousemove', onDocumentMouseMove, false );

				//

				window.addEventListener( 'resize', onWindowResize, false );

			}

			function onWindowResize() {

				windowHalfX = window.innerWidth / 2;
				windowHalfY = window.innerHeight / 2;

				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize( window.innerWidth, window.innerHeight );

			}

			function onDocumentMouseMove( event ) {

				mouseX = ( event.clientX - windowHalfX ) / 2;
				mouseY = ( event.clientY - windowHalfY ) / 2;

			}

			//

			function animate() {

				requestAnimationFrame( animate );
				render();

			}

			function render() {

				camera.position.x += ( mouseX - camera.position.x ) * .1;
				camera.position.y += ( - mouseY - camera.position.y ) * .1;
				camera.lookAt( scene.position );
				renderer.render( scene, camera );
			}
		</script>
		<!--<script src="https://cdn.rawgit.com/zz85/zz85-bookmarklets/master/js/ThreeInspector.js"></script>-->
	</body>
</html>