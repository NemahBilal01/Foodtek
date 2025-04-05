import 'package:flutter/material.dart';

class ChatScreen extends StatefulWidget {
  const ChatScreen({super.key});

  @override
  State<ChatScreen> createState() => _ChatScreenState();
}

class _ChatScreenState extends State<ChatScreen> {
  final TextEditingController messageController=TextEditingController();
  final GlobalKey<FormState> formkey=GlobalKey<FormState>();
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.white,
        elevation: 0,
        titleSpacing: 0,
        title: Row(
          children: [
            IconButton(
              onPressed: () => Navigator.pop(context),
              icon: Icon(Icons.arrow_back, color: Color(0XFF1D1B20)),
              padding: EdgeInsets.zero,
              constraints: BoxConstraints(),
            ),
            SizedBox(width: 2),
            Text(
              'Chat',
              style: TextStyle(
                fontSize: 20,
                fontWeight: FontWeight.w600,
                color: Color(0XFF391713),
              ),
            ),
          ],
        ),
      ),
      body: Column(
        children: [
          Expanded(
            child:
          ListView(
            padding: EdgeInsets.all(14),
            children: [
              buildmessageBubble('Hello chatGPT,how are you today?', true),
              buildmessageBubble('Hello,i’m fine,how can i help you?', false,isAlternate: true),
              buildmessageBubble('What is the best programming language?', true),
              buildmessageBubble('There are many programming languages in the market that are used in designing and building websites, various applications and other tasks. All these languages are popular in their place and in the way they are used, and many programmers learn and use them.',
                  false,isAlternate: false),
              buildmessageBubble('So explain to me more', true),
              buildmessageBubble('There are many programming languages in the market that are used in designing and building websites, various applications and other tasks. All these languages are popular in their place and in the way they are used, and many programmers learn and use them.',
                  false,isAlternate: false),

            ],
          ),),
          buildmessageInputField(messageController, formkey),
        ],
      ),
    );
  }
}
Widget buildmessageBubble(String text,bool isMe,{bool isAlternate=false}){
  return Align(
    alignment: isMe?Alignment.centerRight:Alignment.centerLeft,
    child: Container(
      margin: EdgeInsets.symmetric(vertical: 4),
      padding: EdgeInsets.all(12),
      decoration: BoxDecoration(
        color: isMe?Color(0XFF25AE4B):Color(0XFFEEEEEE),
        borderRadius: BorderRadius.only(
          topLeft: Radius.circular(25),
          bottomRight: Radius.circular(25),
          bottomLeft: Radius.circular(25),
        ),

      ),
      child: Padding(padding: EdgeInsets.all(20),
    child: Text(text,
  style: TextStyle(
  fontSize: 13,
  fontWeight: FontWeight.w700,
  color: isMe
  ? Color(0XFFFFFFFF)
      : isAlternate
  ? Color(0XFF505050) // أول رسالة مستلمة
      : Color(0XFF656565), // ثاني رسالة مستلمة
  ),
    ),

    ),
  ));
}
Widget buildmessageInputField(TextEditingController messageController,GlobalKey<FormState>formkey) {
  return Padding(
    padding: EdgeInsets.all(8),
    child: Form(
      key:formkey ,
      child: SizedBox(
        width: 333,
        height: 56,
        child: Container(
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.circular(30),
            boxShadow: [
              BoxShadow(
                color: Colors.black.withOpacity(0.1), 
                offset: Offset(5, 4),
                blurRadius: 20,
                spreadRadius: 0,
              ),
            ],
          ),
          child: TextFormField(
            controller: messageController,
            decoration: InputDecoration(
              hintText: 'Write Your Message',
              hintStyle: TextStyle(
                color: Color(0XFFA1A1A1),
                fontSize: 13,
                fontWeight: FontWeight.w700,
              ),
              border: InputBorder.none,
              contentPadding: EdgeInsets.symmetric(vertical: 16, horizontal: 22),
              suffixIcon: Padding(
                padding: EdgeInsets.only(right: 10),
                child: Icon(Icons.send, color: Color(0XFF25AE4B)),
              ),
            ),
          ),
        ),


      ),

    ),
  );
}
