import 'package:firebasewithnotification/screens/rest_success_screen.dart';
import 'package:flutter/material.dart';
import 'package:firebase_auth/firebase_auth.dart';

class VerifyCodeScreen extends StatefulWidget {
  const VerifyCodeScreen({super.key});

  @override
  State<VerifyCodeScreen> createState() => _VerifyCodeScreenState();
}


class _VerifyCodeScreenState extends State<VerifyCodeScreen> {
  final List<TextEditingController> codeControllers =
  List.generate(4, (index) => TextEditingController());
  final GlobalKey<FormState> formKey = GlobalKey<FormState>();
  @override
  void initState() {
    super.initState();

    WidgetsBinding.instance.addPostFrameCallback((_) {
      _showVerifyPasswordDialog(context);
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.green,
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

  void _showVerifyPasswordDialog(BuildContext context) {
    showDialog(
      context: context,
      barrierDismissible: false,
      builder: (BuildContext context) {
        return Dialog(
          shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
          child: Padding(
            padding: EdgeInsets.only(top: 289,left: 43),
            child: Align(
             // alignment: Alignment.topCenter,
              child: Container(
                width: 343,height: 389,
                padding: EdgeInsets.all(24),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    Center(child: Image.asset("images/Sent Message.png", width: 153, height: 153),),

                    SizedBox(height: 5),
                    Container(
                      width: 295,
                      height: 34,
                      child: Text(
                        'A 4-digit code has been sent to your email. Please enter it to verify.',
                        style: TextStyle(fontSize: 12, color: Color(0XFF6C7278)),
                      ),
                    ),

                    SizedBox(height: 8),


                    Form(
                      key: formKey,
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                        children: List.generate(4, (index) =>
                            Expanded(
                              child: Container(
                                margin: EdgeInsets.symmetric(horizontal: 5),
                                height: 46,
                                decoration: BoxDecoration(
                                  borderRadius: BorderRadius.circular(10),
                                  border: Border.all(color: Colors.grey),
                                ),
                                child: TextFormField(
                                  controller: codeControllers[index],
                                  textAlign: TextAlign.center,
                                  keyboardType: TextInputType.number,
                                  maxLength: 1,
                                  decoration: InputDecoration(
                                    counterText: "",
                                    border: OutlineInputBorder(),
                                  ),
                                  validator: (value) {
                                    if (value == null || value.isEmpty) {
                                      return '!';
                                    }
                                    return null;
                                  },
                                ),
                              ),
                            ),
                        ),
                      ),
                    ),

                    SizedBox(height: 20),


                    Container(
                      width: 295,
                      height: 48,
                      child: ElevatedButton(
                        onPressed: () {
                          if (formKey.currentState!.validate()) {

                            Navigator.push(context, MaterialPageRoute(builder: (context) => RestSuccessScreen()));
                          }
                        },
                        child: Text(
                          textAlign: TextAlign.center,
                          'Verify',
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
                    ),
                  ],
                ),
              ),
            ),
          ),
        );
      },
    );
  }}
