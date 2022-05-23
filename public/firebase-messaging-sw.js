importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
   
firebase.initializeApp({
    apiKey: "AIzaSyCtGgyy-yt4pBHSWY6MZBGM-EW02RbgHvA",
    projectId: "atfaluna-2",
    messagingSenderId: "189108619003",
    appId: "1:189108619003:web:6bc16ba56413d313b3525e",
});
  
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});