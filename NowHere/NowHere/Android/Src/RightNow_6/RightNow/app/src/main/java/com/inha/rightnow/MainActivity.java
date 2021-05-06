package com.inha.rightnow;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Bitmap;
import android.location.Location;
import android.location.LocationManager;
import android.net.Uri;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.KeyEvent;
import android.webkit.GeolocationPermissions;
import android.webkit.WebChromeClient;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Toast;

import com.google.firebase.iid.FirebaseInstanceId;
import com.gun0912.tedpermission.PermissionListener;
import com.gun0912.tedpermission.TedPermission;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

public class MainActivity extends AppCompatActivity {

    WebView webView;
    String startUrl = "https://www.mynowhere.xyz/app/login.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        PermissionListener permissionlistener = new PermissionListener() {
            @Override
            public void onPermissionGranted() {
//				Toast.makeText(TabRoot.this, "Permission Granted", Toast.LENGTH_SHORT).show();
                start();
            }

            @Override
            public void onPermissionDenied(ArrayList<String> deniedPermissions) {
                Toast.makeText(MainActivity.this, getString(R.string.permission_denied), Toast.LENGTH_SHORT).show();
                finish();
            }
        };

        TedPermission.with(this)
                .setPermissionListener(permissionlistener)
                .setRationaleMessage(getString(R.string.rationale_message))
                .setDeniedMessage(getString(R.string.denied_message))
                .setGotoSettingButtonText("설정")
                .setPermissions(android.Manifest.permission.ACCESS_FINE_LOCATION)
                .check();
    }

    protected  void start()
    {
        setContentView(R.layout.activity_main);

        webView = findViewById(R.id.webView);
        webView.getSettings().setJavaScriptEnabled(true);
        webView.getSettings().setGeolocationEnabled(true);
 //       webView.getSettings().setBuiltInZoomControls(true);
        webView.getSettings().setSupportZoom(true);
        webView.getSettings().setUseWideViewPort( true  );  //더블클릭 확대 축소

        webView.setWebViewClient(new MyWebViewClient());
        webView.setWebChromeClient(new WebChromeClient() {
            public void onGeolocationPermissionsShowPrompt(String origin, GeolocationPermissions.Callback callback) {
                callback.invoke(origin, true, false);
            }
        });

        // HTML5 API flags
        webView.getSettings().setAppCacheEnabled(true);
        webView.getSettings().setDatabaseEnabled(true);
        webView.getSettings().setDomStorageEnabled(true);

        webView.getSettings().setGeolocationDatabasePath( getFilesDir().getPath() );
        webView.loadUrl(startUrl);


        //푸시에 의한 실행 체크
        Intent intent = getIntent();
        if(intent!=null)
        {
            final String url = intent.getStringExtra("url");
            String msg = intent.getStringExtra("msg");
//            String show_msg = intent.getStringExtra("show_msg");
            DLog.d( "getStringExtra(url) = " + url);
            DLog.d( "getStringExtra(msg) = " + msg);

            //url, msg
            if( msg !=null && msg.length() > 0) {
                new AlertDialog.Builder(MainActivity.this)
                        .setTitle("공지사항")
                        .setMessage(msg)
                        .setPositiveButton(android.R.string.ok, new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int whichButton) {
                                if(url !=null && url.length() >0) {
                                    if(url.contains("mynowhere.xyz"))
                                    {
                                        webView.loadUrl(url);
                                    }
                                    else {
                                        Intent i = new Intent(Intent.ACTION_VIEW, Uri.parse(url));
                                        startActivity(i);
                                    }
                                }
                            }
                        })
                        .setNegativeButton(android.R.string.cancel, null)
                        .setCancelable(false)
                        .create().show();

            }
            else
            {
                if(url !=null && url.length() >0) {
                    if(url.contains("mynowhere.xyz"))
                    {
                        webView.loadUrl(url);
                    }
                    else {
                        Intent i = new Intent(Intent.ACTION_VIEW, Uri.parse(url));
                        startActivity(i);
                    }
                }
            }
        }

        //푸시토큰 서버 전송
        String pushToken = FirebaseInstanceId.getInstance().getToken();
        DLog.d( "push token: " + pushToken);
        sendRegistrationToServer(pushToken);

        Location myLocation = getLastKnownLocation();

        if(myLocation!=null) {
            double longitude = myLocation.getLongitude();
            double latitude = myLocation.getLatitude();
            DLog.d("My long=" + longitude + ", lat=" + latitude);
        }
        else
            DLog.d("myLocation=" + myLocation);
    }

    private void sendRegistrationToServer(final String  pushToken) {
        RequestQueue queue = Volley.newRequestQueue(this);
        String url = "https://www.mynowhere.xyz/pushok.php";
        StringRequest postRequest = new StringRequest(Request.Method.POST, url,
                new Response.Listener<String>()
                {
                    @Override
                    public void onResponse(String response) {
                        // response
                        DLog.d("response=" + response);
                    }
                },
                new Response.ErrorListener()
                {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        // TODO Auto-generated method stub
                        DLog.d("Error response=" + error.toString() + " code=" + error.networkResponse.statusCode);
                    }
                }
        )
        {
/*            @Override
            public Map<String, String> getHeaders() {
                Map<String, String>  params = new HashMap<String, String>();
                params.put("Content-Type", "application/x-www-form-urlencoded");

                return params;
            }*/
            @Override
            public Map<String, String> getParams() {
                Map<String, String>  params = new HashMap<String, String>();
                params.put("token", pushToken);
                return params;
            }
        };
        queue.add(postRequest);
    }
    @Override
    public void onBackPressed() {
        if (webView.canGoBack()) {
            webView.goBack();
            //DLog.d( "back url: " + webView.getUrl());
            return;
        }

        super.onBackPressed();
    }

    private class MyWebViewClient extends WebViewClient {
        @Override
        public boolean shouldOverrideUrlLoading(WebView view, String url){
            DLog.d( "url: " + url);
            if(url.startsWith("http"))
                view.loadUrl(url);
            else {
                try {
                    Intent intent = new Intent(Intent.ACTION_VIEW, Uri.parse(url));
                    startActivity(intent);
                }
                catch (Exception e)
                {

                }
            }
            return true;
        }

        @Override
        public void onPageFinished(WebView view, String url){
            DLog.d( "finished url: " + url);
        }

        @Override
        public void onLoadResource(WebView view, String url) {
            // TODO Auto-generated method stub
            super.onLoadResource(view, url);

        }

        public boolean shouldOverrideKeyEvent (WebView view, KeyEvent event) {
            int keyCode = event.getKeyCode();

            if ((keyCode == KeyEvent.KEYCODE_DPAD_LEFT) && view.canGoBack()) {
                view.goBack();
                return true;
            }else if ((keyCode == KeyEvent.KEYCODE_DPAD_RIGHT) && view.canGoForward()) {
                view.goForward();
                return true;
            }

            return false;
        }

        @Override
        public void onPageStarted(WebView view, String url, Bitmap favicon) {
            // TODO Auto-generated method stub
//            findViewById(R.id.progress).setVisibility(View.VISIBLE);
            super.onPageStarted(view, url, favicon);
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
