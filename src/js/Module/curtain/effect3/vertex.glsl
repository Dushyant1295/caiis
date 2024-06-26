#ifdef GL_ES
precision mediump float;
  #endif

  // default mandatory attributes
attribute vec3 aVertexPosition;
attribute vec2 aTextureCoord;

  // those projection and model view matrices are generated by the library
  // it will position and size our plane based on its HTML element CSS values
uniform mat4 uMVMatrix;
uniform mat4 uPMatrix;

  // texture coord varying that will be passed to our fragment shader
varying vec2 vTextureCoord;

void main() {
    // apply our vertex position based on the projection and model view matrices
  gl_Position = uPMatrix * uMVMatrix * vec4(aVertexPosition, 1.0);

    // varying
    // use texture matrix and original texture coords to generate accurate texture coords
  vTextureCoord = aTextureCoord;
}