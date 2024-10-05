
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
            header{
                height: 95vh;
                background-image: linear-gradient(to right, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3)), url("<?= base_url('assets/images/landing.webp')?>");
                background-size: cover;
                background-position: bottom;
                position: relative;
                color: white;
                font-size: 100px;
            }   
            a { color: white; font-size: 20px;}
            body { margin: 0; }
            canvas { display: block; }
    </style>
</head>
<body>

<header>
    <a href="<?= base_url('/') ?>">back</a>
</header>

<div id="3d-model-container" style="width: 100%; height: 600px;"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/examples/js/loaders/OBJLoader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/examples/js/controls/OrbitControls.js"></script>

<script>
    // Setup basic three.js components
    var scene = new THREE.Scene();
    var camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    var renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth, window.innerHeight);
    
    // Append the renderer to the container
    document.getElementById('3d-model-container').appendChild(renderer.domElement);

    // Lighting
    var light = new THREE.DirectionalLight(0xffffff, 1);
    light.position.set(1, 1, 1).normalize();
    scene.add(light);

    // Load the .obj model
    var objLoader = new THREE.OBJLoader();
    objLoader.load('<?= base_url('assets/3d/koltuk.blend')?>', function(object) {
        scene.add(object);
        object.position.y = -1.5; // Adjust the position
    });

    // Set up the camera position
    camera.position.z = 5;

    // Animate the model
    function animate() {
        requestAnimationFrame(animate);
        renderer.render(scene, camera);
    }
    animate();
    var controls = new THREE.OrbitControls(camera, renderer.domElement);
    controls.update();
    function animate() {
        requestAnimationFrame(animate);
        controls.update(); // Update controls
        renderer.render(scene, camera);
    }
    animate();
</script>
</body>
</html>