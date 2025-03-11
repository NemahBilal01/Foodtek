import 'package:firebasewithnotification/screens/location_screen.dart';
import 'package:flutter/material.dart';

class FoodSelectionScreen extends StatelessWidget {
  const FoodSelectionScreen({super.key});

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
              'images/Pattern.png',
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
                        'Choose Your Food',
                        style: TextStyle(
                          fontSize: 32,
                          fontWeight: FontWeight.bold,
                          color: Color(0XFF455A64),
                        ),
                      ),
                      SizedBox(height: 10),
                      Text(
                        'Order Your Favourit Food Within The Plam Of Your Hand And The Zone Of Your Comfort',
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

                SizedBox(height: 20),

                InkWell(
                  onTap: () {

                    Navigator.push(
                      context,
                      MaterialPageRoute(builder: (context) => LocationScreen()),
                    );
                  },

                  borderRadius: BorderRadius.circular(69),
                  child: Ink(
                    decoration: BoxDecoration(
                      gradient: LinearGradient(
                        colors: [Color(0XFF25AE4B), Color(0XFF0F481F),],
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
                        'Continue',
                        style: TextStyle(
                          fontSize: 16,
                          color: Colors.white,
                          fontWeight: FontWeight.w600,
                        ),
                      ),
                    ),
                  ),
                ),
                SizedBox(height: 40),

                /// 4️⃣ شريط التخطي + الدوائر + السهم
                Container(
                  width: 321,
                  height: 26,
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      /// زر "Skip"
                      GestureDetector(
                        onTap: () {
                          Navigator.pushReplacement(
                              context,
                              MaterialPageRoute(
                                  builder: (context) => LocationScreen()));
                        },
                        child: Text(
                          "Skip",
                          style: TextStyle(
                            fontSize: 16,
                            fontWeight: FontWeight.w400,
                            color: Color(0XFF455A64),
                          ),
                        ),
                      ),


                      Row(
                        children: [
                          CircleAvatar(radius: 6, backgroundColor: Colors.grey[300]),
                          SizedBox(width: 8),
                          CircleAvatar(
                              radius: 6, backgroundColor: Colors.grey[300]),
                          SizedBox(width: 8),
                          CircleAvatar(
                              radius: 6, backgroundColor: Colors.green),
                        ],
                      ),


                      GestureDetector(
                        onTap: () {
                          Navigator.pushReplacement(
                              context,
                              MaterialPageRoute(
                                  builder: (context) => LocationScreen()));
                        },
                        child: Icon(Icons.arrow_forward,
                            size: 28, color: Colors.green),
                      ),
                    ],
                  ),
                ),

                SizedBox(height: 20),
              ],
            ),
          ),
        ],
      ),
    );
  }

}


