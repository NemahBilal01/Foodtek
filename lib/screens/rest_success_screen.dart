import 'package:firebasewithnotification/screens/login_screen.dart';
import 'package:flutter/material.dart';
import 'package:firebase_auth/firebase_auth.dart';
import 'package:animations/animations.dart';
import 'package:lottie/lottie.dart';

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
  bool isUpdating = false;


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
            top: 70,
            left: 53,
            child: Image.asset(
              "images/logo.png",
              width: 307,
              height: 85,
            ),
          ),


          SingleChildScrollView(
            child: Align(
              alignment: Alignment.center,
              child: Padding(
                padding: EdgeInsets.symmetric(horizontal: 16, vertical: 150),

                child: Dialog(
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(12),
                  ),
                  child: Padding(
                    padding: const EdgeInsets.all(24),
                    child: Form(
                      key: formKey,
                      child: Column(
                        mainAxisSize: MainAxisSize.min,
                        crossAxisAlignment: CrossAxisAlignment.center,
                        children: [
                          Align(alignment: Alignment.topLeft,
                            child: Positioned(child:
                            Positioned(
                              top: 5,
                              left: 1,
                              child: SizedBox(
                                width: 24,height: 24,
                                child: Align(alignment:Alignment.topLeft,child:IconButton(

                                  onPressed: () {
                                    Navigator.pop(context);
                                  },
                                  icon: Icon(Icons.arrow_back, color: Colors.black,),
                                ),),),
                            ),),
                          ),
                          SizedBox(height: 5,),
                          Text(
                            "Rest Password",
                            style: TextStyle(
                              fontSize: 32,
                              fontWeight: FontWeight.bold,
                              color: Colors.black,
                            ),
                            textAlign: TextAlign.center,
                          ),
                          SizedBox(height: 2),


                          Row(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: [
                              Text(
                                "Want to try with my current password?",
                                style: TextStyle(
                                  fontSize: 12,
                                  color: Color(0XFF6C7278),
                                  fontWeight: FontWeight.w500,
                                ),
                                textAlign: TextAlign.center,
                              ),
                              SizedBox(width: 5),
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
                                  style: TextStyle(
                                    fontSize: 12,
                                    fontWeight: FontWeight.w600,
                                    color: Color(0XFF25AE4B),
                                  ),
                                ),
                              ),
                            ],
                          ),
                          SizedBox(height: 20,),

                          if (isUpdating)
                            Column(
                              mainAxisSize: MainAxisSize.min,
                              children: [
                                Lottie.asset(
                                  'assets/success_animation.json',
                                  width: 343,
                                  height: 287,
                                  fit: BoxFit.fill,
                                ),
                                SizedBox(height: 20),
                                Text(
                                  "Congratulations!",
                                  style: TextStyle(
                                    fontSize: 32,
                                    fontWeight: FontWeight.bold,
                                    color: Colors.black,
                                  ),
                                ),
                                SizedBox(height: 5),
                                Text(
                                  "Password Reset Successfully!",
                                  style: TextStyle(
                                    fontSize: 24,
                                    color: Colors.black,
                                  ),
                                ),
                              ],
                            ),

                          if (!isUpdating)
                            Column(
                              children: [
                                TextFormField(
                                  controller: newPasswordController,
                                  obscureText: _obscureText,

                                  decoration: InputDecoration(
                                    floatingLabelBehavior: FloatingLabelBehavior.always,
                                    labelText: 'New Password',
                                    border: OutlineInputBorder(
                                        borderRadius: BorderRadius.circular(10),
                                        borderSide: BorderSide(
                                          color: Color(0XFFEDF1F3),
                                          width: 1,
                                        )
                                    ),
                                    suffixIcon: IconButton(
                                      onPressed: () {
                                        setState(() {
                                          _obscureText = !_obscureText;
                                        });
                                      },
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
                                    if (value.length < 8) {
                                      return 'Password must be at least 8 characters';
                                    }
                                    if (!RegExp(r'(?=.*[A-Z])').hasMatch(
                                        value)) {
                                      return 'Must contain at least one uppercase letter';
                                    }
                                    if (!RegExp(r'(?=.*[a-z])').hasMatch(
                                        value)) {
                                      return 'Must contain at least one lowercase letter';
                                    }
                                    if (!RegExp(r'(?=.*\d)').hasMatch(value)) {
                                      return 'Must contain at least one number';
                                    }
                                    if (!RegExp(r'(?=.*[@$!%*?&])').hasMatch(
                                        value)) {
                                      return 'Must contain at least one special character';
                                    }
                                    return null;
                                  },
                                ),
                                SizedBox(height: 24),
                                TextFormField(
                                  controller: confirmPasswordController,
                                  obscureText: _obscureText,
                                  decoration: InputDecoration(
                                    labelText: 'Confirm New Password',
                                    floatingLabelBehavior: FloatingLabelBehavior.always,
                                    border: OutlineInputBorder(
                                      borderRadius: BorderRadius.circular(10),
                                      borderSide: BorderSide(
                                        color: Color(0XFFEDF1F3),width: 1,
                                      ),
                                    ),
                                    suffixIcon: IconButton(
                                      onPressed: () {
                                        setState(() {
                                          _obscureText = !_obscureText;
                                        });
                                      },
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
                                SizedBox(height: 24),
                                ElevatedButton(
                                  onPressed: () async {
                                    if (formKey.currentState!.validate()) {
                                      setState(() {
                                        isUpdating = true;
                                      });
                                      await updatePassword();
                                    }
                                  },
                                  child: Text(
                                    'Update Password',
                                    textAlign: TextAlign.center,
                                    style: TextStyle(
                                        fontSize: 14, color: Colors.white),
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
                        ],
                      ),
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