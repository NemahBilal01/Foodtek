import 'package:firebase_auth/firebase_auth.dart';
import 'package:firebasewithnotification/screens/verify_code_screen.dart';
import 'package:flutter/gestures.dart';
import 'package:flutter/material.dart';

import 'login_screen.dart';

class ResetPasswordScreen extends StatefulWidget {
  const ResetPasswordScreen({super.key});

  @override
  State<ResetPasswordScreen> createState() => _ResetPasswordScreenState();
}

class _ResetPasswordScreenState extends State<ResetPasswordScreen> {
  final TextEditingController emailController = TextEditingController();
  final GlobalKey<FormState> formKey = GlobalKey<FormState>();
  Future<void> sendPasswordResetEmail() async {
    if (formKey.currentState!.validate()) {
      try {
        await FirebaseAuth.instance.sendPasswordResetEmail(
          email: emailController.text.trim(),
        );
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text("Password reset email sent!")),
        );
        Navigator.push(
          context,
          MaterialPageRoute(builder: (context) => VerifyCodeScreen()),
        );
      } catch (e) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(content: Text(e.toString())),
        );
      }
    }
  }

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      _showRestPasswordDialog(context);
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Color(0XFF25AE4B),
      body: Stack(
        children: [
          Positioned.fill(
              child: Image.asset("images/Pattern.png", fit: BoxFit.cover)),
          Positioned(
            top: 74,
            left: 61,
            child: Image.asset(
              "images/logo.png",
              width: 307,
              height: 85,
            ),
          ),
        ],
      ),
    );
  }

  void _showRestPasswordDialog(BuildContext context) {
    showDialog(
      context: context,
      barrierDismissible: false,
      builder: (BuildContext context) {
        return Dialog(
          shape: RoundedRectangleBorder(
              borderRadius: BorderRadius.circular(12)),
          child: Padding(
            padding: EdgeInsets.symmetric(vertical: 10), // لضبط المحاذاة
            child: Align(
             // alignment: Alignment.center, // تحديد مكانه في المنتصف

              child: Container(
                width: 343,
                padding: EdgeInsets.all( 16,),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  mainAxisSize: MainAxisSize.min,
                  children: [

                    Row(
                      children: [
                        IconButton(
                          onPressed: () {
                            Navigator.pop(context);
                          },
                          icon: Icon(Icons.arrow_back, color: Colors.black),
                        ),
                        Text(
                          "Back to ",
                          style: TextStyle(fontSize: 14, color: Colors.grey),
                        ),
                        TextButton(
                          onPressed: () {
                            Navigator.push(
                              context,
                              MaterialPageRoute(
                                  builder: (context) => LogInScreen()),
                            );
                          },
                          child: Text(
                            "Login",
                            style: TextStyle(fontSize: 14,
                                color: Color(0XFF25AE4B),
                                fontWeight: FontWeight.bold),
                          ),
                        ),
                        Text(
                          "page?",
                          style: TextStyle(fontSize: 14, color: Colors.grey),
                        ),
                      ],
                    ),

                    SizedBox(height: 10),

                    Text(
                      'Rest Password',
                      style: TextStyle(fontSize: 32, color: Color(0XFF111827)),
                    ),

                    SizedBox(height: 5),

                    Text(
                      "Enter your E-mail or phone and we'll send you a link to get back into your account",
                      style: TextStyle(fontSize: 12, color: Color(0XFF6C7278)),
                      maxLines: 3,
                      softWrap: true,
                    ),

                    SizedBox(height: 20),

                    // ✅ جعل TextFormField داخل Form
                    Form(
                      key: formKey,
                      child: TextFormField(
                        controller: emailController,
                        keyboardType: TextInputType.emailAddress,
                        decoration: InputDecoration(
                          labelText: 'Email',
                          floatingLabelBehavior: FloatingLabelBehavior.always,
                          border: OutlineInputBorder(),
                        ),
                        validator: (value) {
                          if (value == null || value.isEmpty) {
                            return 'Please enter your email';
                          } else if (!RegExp(
                              r'^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$')
                              .hasMatch(value)) {
                            return 'Enter a valid email address';
                          }
                          return null;
                        },
                      ),
                    ),

                    SizedBox(height: 10),

                    ElevatedButton(
                      onPressed: () {

                        if (formKey.currentState!.validate()) {

                          sendPasswordResetEmail();
                          FirebaseAuth.instance.sendPasswordResetEmail(email: emailController.text.trim());

                          Navigator.push(
                            context,
                            MaterialPageRoute(
                                builder: (context) => VerifyCodeScreen()),
                          );
                        }
                      },
                      child: Text(
                        'Send',
                        style: TextStyle(fontSize: 14, color: Colors.white),
                      ),
                      style: ElevatedButton.styleFrom(
                        minimumSize: Size(295, 48),
                        padding: EdgeInsets.symmetric(
                            horizontal: 24, vertical: 10),
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
        );
      },
    );
  }
}
