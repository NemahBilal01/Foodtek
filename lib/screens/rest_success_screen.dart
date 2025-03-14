import 'package:firebasewithnotification/screens/login_screen.dart';
import 'package:flutter/material.dart';
import 'package:firebase_auth/firebase_auth.dart';
import 'package:animations/animations.dart';

class RestSuccessScreen extends StatefulWidget {
  const RestSuccessScreen({super.key});

  @override
  State<RestSuccessScreen> createState() => _RestSuccessScreenState();
}

class _RestSuccessScreenState extends State<RestSuccessScreen> {
  final TextEditingController newPasswordController = TextEditingController();
  final TextEditingController confirmPasswordController = TextEditingController();
  final GlobalKey<FormState> formKey = GlobalKey<FormState>();
  bool _obscureText = true;
  bool isUpdating = false; // Flag for update process


  Future<void> updatePassword() async {
    if (formKey.currentState!.validate()) {
      setState(() {
        isUpdating = true;
      });
      await Future.delayed(Duration(seconds: 2));
      try {
        User? user = FirebaseAuth.instance.currentUser;
        if (user != null) {
          await user.updatePassword(newPasswordController.text.trim());
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(content: Text("Password updated successfully!")),
          );
          Navigator.pushReplacement(
            context,
            MaterialPageRoute(builder: (context) => LogInScreen()),
          );
        }
      } catch (e) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text(e.toString())),
        );
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Color(0XFF25AE4B),
      body: Stack(
        children: [

          Positioned.fill(
            child: Image.asset(
              "images/Pattern.png",
              fit: BoxFit.cover,
            ),
          ),
          Positioned(
            top: 74,
            left: 61,
            child: Image.asset(
              "images/logo.png",
              width: 307,
              height: 85,
            ),
          ),

          Center(
            child: Padding(
              padding: EdgeInsets.all(16.0),
              child: Dialog(
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(12),

                ),
                child: Padding(
                  padding: EdgeInsets.all(16.0),
                  child: Form(
                    key: formKey,
                    child: Column(
                      mainAxisSize: MainAxisSize.min,
                      children: [

                        if (isUpdating)
                          FadeScaleTransition(
                            animation: AlwaysStoppedAnimation(1.0),
                            child: Column(
                              mainAxisSize: MainAxisSize.min,
                              children: [
                                Opacity(
                                  opacity: 0,
                                  child: Image.asset(
                                    'images/animation.png',
                                    width: 430.5,
                                    height: 287,
                                    fit: BoxFit.fill,
                                  ),
                                ),
                                SizedBox(height: 20),
                                Opacity(
                                  opacity: 0,
                                  child: Text(
                                    "Congratulations!",
                                    style: TextStyle(
                                      fontSize: 32,
                                      fontWeight: FontWeight.bold,
                                      color: Colors.white,
                                    ),
                                  ),
                                ),SizedBox(height: 5,),
                                Opacity(
                                  opacity: 1.0,
                                  child: Text(
                                    "Password Reset Successfully!",
                                    style: TextStyle(
                                      fontSize: 24,

                                      color: Colors.white,
                                    ),
                                  ),
                                ),
                              ],
                            ),
                          ),

                        if (!isUpdating)
                          TextFormField(
                            controller: newPasswordController,
                            obscureText: _obscureText,
                            decoration: InputDecoration(
                              labelText: 'New Password',
                              suffixIcon: IconButton(
                                onPressed: () {},
                                icon: Icon(
                                  _obscureText
                                      ? Icons.visibility_off
                                      : Icons.visibility,
                                  color: Colors.grey,
                                ),
                              ),
                            ),
                            validator: (value) {
                              if (value == null || value.isEmpty) {
                                return 'Please enter a new password';
                              }
                              if (value.length < 6) {
                                return 'Password must be at least 6 characters long';
                              }
                              return null;
                            },
                          ),
                        SizedBox(height: 10),
                        if (!isUpdating)
                          TextFormField(
                            controller: confirmPasswordController,
                            obscureText: _obscureText,
                            decoration: InputDecoration(
                              labelText: 'Confirm New Password',
                              suffixIcon: IconButton(
                                onPressed: () {},
                                icon: Icon(
                                  _obscureText
                                      ? Icons.visibility_off
                                      : Icons.visibility,
                                  color: Colors.grey,
                                ),
                              ),
                            ),
                            validator: (value) {
                              if (value == null || value.isEmpty) {
                                return 'Please confirm your password';
                              }
                              if (value != newPasswordController.text) {
                                return 'Passwords do not match';
                              }
                              return null;
                            },
                          ),
                        SizedBox(height: 10),
                        if (!isUpdating)
                          ElevatedButton(
                            onPressed: () async {
                              if (formKey.currentState!.validate()) {
                                await updatePassword(); // Call updatePassword function
                              }
                            },
                            child: Text(
                              'Update Password',
                              textAlign: TextAlign.center,
                              style: TextStyle(fontSize: 14, color: Colors.white),
                            ),
                            style: ElevatedButton.styleFrom(
                              minimumSize: Size(295, 48),
                              shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(10),
                              ),
                              backgroundColor: Color(0XFF25AE4B),
                            ),
                          ),
                      ],
                    ),
                  ),
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}
