
import 'package:flutter/material.dart';

class EmptyState extends StatelessWidget {
  final String text;
  final String subText;
  final String imagePath;



  EmptyState({required this.text, required this.subText,required this.imagePath});

  @override
  Widget build(BuildContext context) {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Image.asset(imagePath,width: 282,height: 282,),
          
          SizedBox(height: 20),
          Text(
            text,
            style: TextStyle(fontSize: 32, fontWeight: FontWeight.w700,color: Color(0XFF111827)),
          ),
          SizedBox(height: 8),
          Text(
            subText,
            style: TextStyle(fontSize: 16, color: Color(0XFF6C7278),fontWeight: FontWeight.w500),
            textAlign: TextAlign.center,
          ),
        ],
      ),
    );
  }
}