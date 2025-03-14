import 'package:firebasewithnotification/screens/login_screen.dart';
import 'package:firebasewithnotification/screens/reset_password_screen.dart';
import 'package:flutter/material.dart';
import 'package:geolocator/geolocator.dart';
class LocationScreen extends StatelessWidget {
  const LocationScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(

        body: Stack(
          children: [

          Positioned(
          top: 0,
          left: 0,
          right: 0,
          child: Image.asset(
            'images/maps.png',
            fit: BoxFit.cover,
            width: double.infinity,
            height: 200,
          ),
        ),


        SingleChildScrollView(
        child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
        SizedBox(height: 220),


    Image.asset('images/Take Away.png', width: 328.5, height: 219),

    SizedBox(height: 20),


    Container(
    width: 335,
    height: 158,
    child: Column(
    crossAxisAlignment: CrossAxisAlignment.center,
    children: [
    Text(
    'Turn On Your Location',
    style: TextStyle(
    fontSize: 32,
    fontWeight: FontWeight.bold,
    color: Color(0XFF455A64),
    ),
    ),
    SizedBox(height: 10),
    Text(
    "To Continues,Let Your Device Turn On Location,Which Uses Google's Location Service",
    textAlign: TextAlign.center,
    style: TextStyle(
    fontWeight: FontWeight.w400,
    fontSize: 16,
    color: Color(0XFF455A64),
    ),
    ),
    ],
    ),
    ),



          InkWell(
            onTap: () async {
              try {
                Position position = await _determinePosition();
                print(" ${position.latitude}, ${position.longitude}");

                Navigator.pushReplacement(
                  context,
                  MaterialPageRoute(builder: (context) => LogInScreen()),
                );
              } catch (e) {
                print(" $e");

                ScaffoldMessenger.of(context).showSnackBar(
                  SnackBar(content: Text("Site permission must be granted to use this feature")),
                );
              }
            },
            borderRadius: BorderRadius.circular(69),
            child: Ink(
              decoration: BoxDecoration(
                gradient: LinearGradient(
                  colors: [Color(0xFF25AE4B), Color(0xFF0D8344)],
                  begin: Alignment.topLeft,
                  end: Alignment.bottomRight,
                ),
                borderRadius: BorderRadius.circular(69),
              ),
              child: Container(
                width:307 ,height:48 ,
                padding: EdgeInsets.only(top: 14,bottom: 14),
                alignment: Alignment.center,
                child: Text(
                  'Yes, Turn It On',
                  style: TextStyle(
                    fontSize: 16,
                    color: Colors.white,
                    fontWeight: FontWeight.w600,
                  ),
                ),
              ),
            ),
          ),



          SizedBox(height: 5,),
          ElevatedButton(
            onPressed: () {
              Navigator.pushReplacement(
                  context,
                  MaterialPageRoute(
                      builder: (context) => ResetPasswordScreen()));
            },
            style: ElevatedButton.styleFrom(
              minimumSize: Size(307, 48),
              padding: EdgeInsets.only(top: 14,bottom: 14),
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(69),
              ),
              backgroundColor: Color(0XFFC2C2C2),
            ),
            child: Text(
              'Cancel',
              style: TextStyle(
                fontSize: 16,
                color: Color(0XFFFFFFFF),
                fontWeight: FontWeight.w600,
              ),
            ),
          ),




    ],
    ),),],),);
  }
}
Future<Position> _determinePosition() async {
  bool serviceEnabled;
  LocationPermission permission;

  // Test if location services are enabled.
  serviceEnabled = await Geolocator.isLocationServiceEnabled();
  if (!serviceEnabled) {
    // Location services are not enabled don't continue
    // accessing the position and request users of the
    // App to enable the location services.
    return Future.error('Location services are disabled.');
  }

  permission = await Geolocator.checkPermission();
  if (permission == LocationPermission.denied) {
    permission = await Geolocator.requestPermission();
    if (permission == LocationPermission.denied) {

      return Future.error('Location permissions are denied');
    }
  }

  if (permission == LocationPermission.deniedForever) {

    return Future.error(
        'Location permissions are permanently denied, we cannot request permissions.');
  }


  return await Geolocator.getCurrentPosition();
}
