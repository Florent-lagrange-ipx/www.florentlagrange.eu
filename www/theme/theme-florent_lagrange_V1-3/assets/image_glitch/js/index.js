var container, stats;

var camera, scene, renderer, composer;

var mesh, group1, group2, light, sphere, lightMesh, quaternion, ring;

var mouseX = 0, mouseY = 0;

var SCREEN_WIDTH = window.innerWidth;
var SCREEN_HEIGHT = window.innerHeight;

var windowHalfX = window.innerWidth / 2;
var windowHalfY = window.innerHeight / 2;

function init(){
  scene = new THREE.Scene();

  //camera
  camera = new THREE.PerspectiveCamera( 20, SCREEN_WIDTH / SCREEN_HEIGHT, 1, 10000 );
  camera.position.z = 2000;

  //light
  light = new THREE.DirectionalLight( 0xffffff );
  light.position.set( .5, .5, .5 );
  scene.add( light );
  scene.fog = new THREE.Fog( 0x000000, 100, 1 );


  sphere = new THREE.SphereGeometry( 10, 16, 8, 1 );
  lightMesh = new THREE.Mesh( sphere, new THREE.MeshBasicMaterial( { color: 0x000000 } ) );
  scene.add( lightMesh );

  var faceIndices = [ 'a', 'b', 'c', 'd' ];
  var color, f, p, n, vertexIndex,
    radius = 180,
    geometry  = new THREE.IcosahedronGeometry( radius, 3 );

  var materials = [
    new THREE.MeshLambertMaterial( { color: 0xffffff, shading: THREE.FlatShading, vertexColors: THREE.VertexColors } )
  ];

  group1 = THREE.SceneUtils.createMultiMaterialObject( geometry, materials );
  group1.position.x = 0;
  scene.add( group1 );

  ring = new THREE.TorusGeometry( 210, 1, 100, 50 );
  var ringMaterial = new THREE.MeshLambertMaterial( {color: 0xffffff, shading: THREE.SmoothShading, vertexColors: THREE.VertexColors, side: THREE.DoubleSide } );
  group2 = new THREE.Mesh( ring, ringMaterial );
  scene.add( group2 );

  renderer = new THREE.WebGLRenderer( { antialias: true } );
  renderer.setClearColor( 0xffffff );
  renderer.setSize( window.innerWidth, window.innerHeight );
  renderer.setPixelRatio( window.devicePixelRatio / 2);
  $('.page-content').append( renderer.domElement );
 
  // postprocessing

  composer = new THREE.EffectComposer( renderer );
  composer.addPass( new THREE.RenderPass( scene, camera ) );
  
  var effect = new THREE.ShaderPass( THREE.DotScreenShader );
  effect.uniforms[ 'scale' ].value = 30;
  composer.addPass( effect );

  var effect = new THREE.ShaderPass( THREE.RGBShiftShader );
  effect.uniforms[ 'amount' ].value = 0.01;
  effect.renderToScreen = true;
  
  composer.addPass( effect );
  composer.addPass( effect );
    
  var glitch = new THREE.GlitchPass(100);
  glitch.renderToScreen = true;
  composer.addPass(glitch);
  
  
 
}

function render() {

  var timer = Date.now() * 0.0010;
  camera.lookAt( scene.position );
  
  /*group1.rotation.x = timer;*/
  /*group1.rotation.y = timer / 2;*/
  group1.rotation.z = (timer / 2) + 45;
  
  group2.rotation.x = timer;
  group2.rotation.y = 45;
  
  composer.render();

/*  renderer.render( scene, camera );*/
}

function animate() {

  requestAnimationFrame( animate );
  render();

}

init();
animate();