package com.inha.rightnow;

import android.app.Notification;
import android.app.NotificationChannel;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.location.Location;
import android.location.LocationManager;
import android.media.RingtoneManager;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.util.Log;

import com.google.firebase.messaging.FirebaseMessagingService;
import com.google.firebase.messaging.RemoteMessage;

import java.util.List;
import java.util.Map;

/**
 * Created by hyun on 2016-10-02.
 */

public class MyFirebaseMessagingService extends FirebaseMessagingService {

    /**
     * Called when message is received.
     *
     * @param remoteMessage Object representing the message received from Firebase Cloud Messaging.
     */
    // [START receive_message]
    @Override
    public void onMessageReceived(RemoteMessage remoteMessage) {


        //푸시받은 후 나의 위치 구하기
        Location myLocation = getLastKnownLocation();
        double longitude = 0;
        double latitude = 0;
        if(myLocation!=null) {
            longitude = myLocation.getLongitude();
            latitude = myLocation.getLatitude();
        }
        DLog.d( "My long=" +  longitude + ", lat=" + latitude);



        // TODO(developer): Handle FCM messages here.
        // Not getting messages here? See why this may be: https://goo.gl/39bRNJ
        DLog.d( "From: " + remoteMessage.getFrom());

        // Check if message contains a data payload.
        if (remoteMessage.getData().size() > 0) {
            DLog.d( "Message data payload: " + remoteMessage.getData());
        }

        // Check if message contains a notification payload.
        if (remoteMessage.getNotification() != null) {
            DLog.d( "Message Notification Body: " + remoteMessage.getNotification().getBody());
        }
        // [END receive_message]

        // Also if you intend on generating your own notifications as a result of a received FCM
        // message, here is where that should be initiated. See sendNotification method below.

        if (remoteMessage.getNotification() != null)
        {
            Intent intent = new Intent(this, MainActivity.class);
            intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
            if (remoteMessage.getData().size() > 0) {
                Map<String, String> map = remoteMessage.getData();
                Bundle bundle = new Bundle();
                for (Map.Entry<String, String> entry : map.entrySet()) {
                    bundle.putString(entry.getKey(), entry.getValue());
                }
                intent.putExtras(bundle);
            }

            PendingIntent pendingIntent = PendingIntent.getActivity(this, 0 /* Request code */, intent,
                    PendingIntent.FLAG_ONE_SHOT);
            Uri defaultSoundUri = RingtoneManager.getDefaultUri(RingtoneManager.TYPE_NOTIFICATION);
            Bitmap bmpIcon =  BitmapFactory.decodeResource(getResources(), R.mipmap.logo_app);
            Notification.Builder notificationBuilder;
            NotificationManager notificationManager = (NotificationManager) getSystemService(this.NOTIFICATION_SERVICE);
            if(Build.VERSION.SDK_INT >= Build.VERSION_CODES.O)
            {
                NotificationChannel mChannel = new NotificationChannel("ch_01", "RightNow notifications", NotificationManager.IMPORTANCE_DEFAULT);
                notificationManager.createNotificationChannel(mChannel);
                notificationBuilder = new Notification.Builder(this, "ch_01");
            }
            else
            {
                notificationBuilder = new Notification.Builder(this);
            }
            notificationBuilder.setSmallIcon(R.mipmap.logo_app)
                    .setLargeIcon(bmpIcon)
                    .setContentTitle(remoteMessage.getNotification().getTitle())
                    .setContentText(remoteMessage.getNotification().getBody())
//                    .setStyle(new Notification.BigTextStyle().bigText(remoteMessage.getNotification().getBody()))
                    .setAutoCancel(true)
//                    .setSound(defaultSoundUri)
                    .setContentIntent(pendingIntent);
            notificationManager.notify(0 /* ID of notification */, notificationBuilder.build());

        }
        else
        {
            Intent intent = new Intent(this, MainActivity.class);
            intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
            String title="";
            String body = "";
            if (remoteMessage.getData().size() > 0) {
                Map<String, String> map = remoteMessage.getData();
                Bundle bundle = new Bundle();
                for (Map.Entry<String, String> entry : map.entrySet()) {
                    bundle.putString(entry.getKey(), entry.getValue());
                }
                intent.putExtras(bundle);

                float distance = 0;
                float availDistance = 0;
                try {
                    title = map.get("title");
                    body = map.get("body");
                    Location eventPoint = new Location("eventPoint");
                    eventPoint.setLatitude(Double.valueOf(map.get("latitude")));
                    eventPoint.setLongitude(Double.valueOf(map.get("longitude")));

                    DLog.d("Point long=" + eventPoint.getLongitude() + ", lat=" + eventPoint.getLatitude());

                    distance = myLocation.distanceTo(eventPoint);
                    DLog.d("distance=" + distance);
                    availDistance = Float.valueOf(map.get("distance"));
                } catch (Exception e){
                    e.printStackTrace();
                }
                if( distance > availDistance) return;
            }

            PendingIntent pendingIntent = PendingIntent.getActivity(this, 0 /* Request code */, intent,
                    PendingIntent.FLAG_ONE_SHOT);
            Uri defaultSoundUri = RingtoneManager.getDefaultUri(RingtoneManager.TYPE_NOTIFICATION);
            Bitmap bmpIcon =  BitmapFactory.decodeResource(getResources(), R.mipmap.logo_app);
            Notification.Builder notificationBuilder;
            NotificationManager notificationManager = (NotificationManager) getSystemService(this.NOTIFICATION_SERVICE);
            if(Build.VERSION.SDK_INT >= Build.VERSION_CODES.O)
            {
                NotificationChannel mChannel = new NotificationChannel("ch_01", "RightNow notifications", NotificationManager.IMPORTANCE_DEFAULT);
                notificationManager.createNotificationChannel(mChannel);
                notificationBuilder = new Notification.Builder(this, "ch_01");
            }
            else
            {
                notificationBuilder = new Notification.Builder(this);
            }
            notificationBuilder.setSmallIcon(R.mipmap.logo_app)
                    .setLargeIcon(bmpIcon)
                    .setContentTitle(title)
                    .setContentText(body)
//                    .setStyle(new Notification.BigTextStyle().bigText(remoteMessage.getNotification().getBody()))
                    .setAutoCancel(true)
//                    .setSound(defaultSoundUri)
                    .setContentIntent(pendingIntent);
            notificationManager.notify(0 /* ID of notification */, notificationBuilder.build());
        }
    }

    LocationManager mLocationManager;
    private Location getLastKnownLocation() {
        mLocationManager = (LocationManager)getApplicationContext().getSystemService(LOCATION_SERVICE);
        List<String> providers = mLocationManager.getProviders(true);
        Location bestLocation = null;
        for (String provider : providers) {
            Location l = mLocationManager.getLastKnownLocation(provider);
            if (l == null) {
                continue;
            }
            if (bestLocation == null || l.getAccuracy() < bestLocation.getAccuracy()) {
                // Found best last known location: %s", l);
                bestLocation = l;
            }
        }
        return bestLocation;
    }
}

