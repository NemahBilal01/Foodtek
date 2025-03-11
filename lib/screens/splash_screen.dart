import 'dart:async';
import 'dart:math';
import 'package:firebasewithnotification/screens/welcome_screen.dart';
import 'package:flutter/material.dart';


class SplashScreen extends StatefulWidget {
  const SplashScreen({super.key});

  @override
  State<SplashScreen> createState() => _SplashScreenState();
}

class _SplashScreenState extends State<SplashScreen> {
  @override
  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    Timer(Duration(seconds: 3), () {
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(builder: (context) => WelcomeScreen()),
      );
    });

  }
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.green,
      body:Stack(
        children: [
          /// ✅ الخلفية: صورة تملأ الشاشة بالكامل
          Positioned.fill(
            child: Image.asset(
              'images/Pattern.png', // تأكد من وضع المسار الصحيح للصورة
              fit: BoxFit.cover, // لجعل الصورة تغطي الشاشة بالكامل
            ),
          ),

          /// ✅ اللوجو في منتصف الشاشة
          Center(
            child: Image.asset(
              'images/logo.png', // مسار اللوجو
              width: 307, height: 85,// يمكنك تغيير الحجم حسب الحاجة
            ),
          ),
        ],
      ),
    );
  }
}


