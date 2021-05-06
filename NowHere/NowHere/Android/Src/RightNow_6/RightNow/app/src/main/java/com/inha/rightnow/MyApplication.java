package com.inha.rightnow;

import android.app.Application;
import android.app.NotificationChannel;
import android.app.NotificationManager;
import android.os.Build;
import android.util.Log;


public class MyApplication extends Application {

	@Override
	public void onCreate() {
		super.onCreate();
		DLog.d("MyApplication Start");
		if(Build.VERSION.SDK_INT >= Build.VERSION_CODES.O)
		{
			NotificationChannel mChannel = new NotificationChannel("ch_01", "RightNow notifications", NotificationManager.IMPORTANCE_DEFAULT);
			NotificationManager notificationManager = (NotificationManager) getSystemService(this.NOTIFICATION_SERVICE);
			notificationManager.createNotificationChannel(mChannel);
		}
	}
}
