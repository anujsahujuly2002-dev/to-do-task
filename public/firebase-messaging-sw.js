importScripts('https://www.gstatic.com/firebasejs/7.20.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.20.0/firebase-messaging.js');

firebase.initializeApp({
  apiKey: "AIzaSyDU7pGK50KqveJI0Ksf41LlSM4SfikkMoc",
    authDomain: "dookopps.firebaseapp.com",
    projectId: "dookopps",
    storageBucket: "dookopps.appspot.com",
    messagingSenderId: "150767825701",
    appId: "1:150767825701:web:f1a5a310ee699ded8aa0cc",
    measurementId: "G-4FZVRCCY44"
});

const messaging = firebase.messaging();