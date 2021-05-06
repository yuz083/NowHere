package com.inha.rightnow;

import android.util.Log;

/**
 * Created by jhkang on 2016-11-15.
 */

public   class DLog {
//    static boolean DEBUG = false;
    static final String TAG = "RightNow";


    /**
     * Log Level Error
     **/
    public static final void e(String message) {
        if (BuildConfig.DEBUG) Log.e(TAG, buildLogMsg(message));
    }

    /**
     * Log Level Warning
     **/
    public static final void w(String message) {
        if (BuildConfig.DEBUG) Log.w(TAG, buildLogMsg(message));
    }

    /**
     * Log Level Information
     **/
    public static final void i(String message) {
        if (BuildConfig.DEBUG) Log.i(TAG, buildLogMsg(message));
    }

    /**
     * Log Level Debug
     **/
    public static final void d(String message) {
        if (BuildConfig.DEBUG) Log.d(TAG, buildLogMsg(message));
    }

    /**
     * Log Level Verbose
     **/
    public static final void v(String message) {
        if (BuildConfig.DEBUG) Log.v(TAG, buildLogMsg(message));
    }


    public static String buildLogMsg(String message) {

        StackTraceElement ste = Thread.currentThread().getStackTrace()[4];

        StringBuilder sb = new StringBuilder();

        sb.append("[");
        sb.append(ste.getFileName().replace(".java", ""));
        sb.append("::");
        sb.append(ste.getMethodName());
        sb.append(("::"));
        sb.append(ste.getLineNumber());
        sb.append("]");
        sb.append(message);

        return sb.toString();

    }

}

