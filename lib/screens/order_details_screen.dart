import 'package:flutter/material.dart';
import 'package:flutter_rating_bar/flutter_rating_bar.dart';

class OrderDetailsScreen extends StatefulWidget {
  const OrderDetailsScreen({super.key});

  @override
  State<OrderDetailsScreen> createState() => _OrderDetailsScreenState();
}

class _OrderDetailsScreenState extends State<OrderDetailsScreen> {
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
              'Order Details',
              style: TextStyle(
                fontSize: 20,
                fontWeight: FontWeight.w600,
                color: Color(0XFF391713),
              ),
            ),
          ],
        ),
      ),
      body: SingleChildScrollView(
        padding: EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Row(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Image.asset('images/Order ID.png', width: 44,height: 44,),
                SizedBox(width: 10),
                Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text('Order ID',
                        style: TextStyle(
                            fontSize: 16,
                            color: Color(0XFF391713),
                            fontWeight: FontWeight.w600)),
                    Text('#6579-6432',
                        style: TextStyle(
                            fontSize: 10,
                            color: Color(0XFF878787),
                            fontWeight: FontWeight.w500)),
                    Text('25m',
                        style: TextStyle(
                            fontSize: 12,
                            color: Color(0XFF263238),
                            fontWeight: FontWeight.w500)),
                  ],
                ),
              ],
            ),
            SizedBox(height: 20),
            buildOrderTimeLine(),
            SizedBox(height: 20),
            buildDeliveryHeroCard(),
            SizedBox(height: 50),
            Center(
              child:ElevatedButton(
                onPressed: () {},
                child: Text(
                  'Live Track',
                  style: TextStyle(
                    fontSize: 14,
                    color: Color(0XFFFFFFFF),
                    fontWeight: FontWeight.w500,
                  ),
                ),
                style: ElevatedButton.styleFrom(
                  minimumSize: Size(295, 48),
                  backgroundColor: Color(0XFF25AE4B),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(10),
                  ),
                ),
              ),

            ),
          ],
        ),
      ),
    );
  }
}

Widget buildOrderTimeLine() {
  return Column(
    children: [
      buildTimeLineStep('Order received', true, Icons.check, true),
      buildTimeLineStep('Cooking your order', true, Icons.commute_outlined, true),
      buildTimeLineStep('Courier is picking up order', true, Icons.person,false),
      buildTimeLineStep('Order delivered', false, Icons.home, false),
    ],
  );
}

Widget buildTimeLineStep(String text, bool isCompleted, IconData icon, bool isLineGreen) {
  bool isLastStep = text == 'Order delivered';
  return Row(
    crossAxisAlignment: CrossAxisAlignment.start,
    children: [
      Column(
        children: [
          Container(
            width: 39.07,
            height: 40,
            decoration: BoxDecoration(
              color: isCompleted ? Color(0XFF25AE4B) : Color(0XFFF7F7F7),
              shape: BoxShape.circle,
            ),
            child: Icon(
              icon,
              color: isLastStep ? Color(0XFFA09CAB) : Colors.white,
              size: 20,
            ),
          ),
          if (!isLastStep)
            Container(
              width: 2,
              height: 30,
              color: isLineGreen ? Color(0XFF25AE4B) : Color(0XFFF7F7F7),
            ),
        ],
      ),
      SizedBox(width: 10),
      Expanded(
        child: Padding(
          padding: EdgeInsets.only(top: 10),
          child: Text(
            text,
            style: TextStyle(
              fontSize: 16,
              fontWeight: FontWeight.w600,
              color: Color(0XFF1C1B1F),
            ),
          ),
        ),
      ),
    ],
  );
}


Widget buildDeliveryHeroCard() {
  return Column(
    crossAxisAlignment: CrossAxisAlignment.start,
    children: [
      Row(
        children: [
          CircleAvatar(
            radius: 20,
            backgroundImage: AssetImage('images/photo.png'),
          ),
          SizedBox(width: 10),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  'Your Delivery Hero',
                  style: TextStyle(
                    fontSize: 12,
                    fontWeight: FontWeight.w500,
                    color: Color(0XFF878787),
                  ),
                ),
                Row(
                  children: [
                    Text(
                      'Aleksandr V.',
                      style: TextStyle(
                        fontSize: 15,
                        color: Color(0XFF2F2E36),
                        fontWeight: FontWeight.w400,
                      ),
                    ),
                    SizedBox(width: 8),
                    Icon(Icons.star, color: Color(0XFFF2AB58), size: 16),
                    SizedBox(width: 4),
                    Text(
                      '4.9',
                      style: TextStyle(
                        fontSize: 14,
                        fontWeight: FontWeight.w500,
                        color: Color(0XFF2F2E36),
                      ),
                    ),
                  ],
                ),
              ],
            ),
          ),
          CircleAvatar(
            radius: 20,
            backgroundColor: Color(0XFFF5F5F5),
            child: IconButton(
              onPressed: () {},
              icon: Icon(Icons.phone, color: Color(0XFF4CAF50)),
            ),
          ),
          SizedBox(width: 8),
          CircleAvatar(
            radius: 20,
            backgroundColor: Color(0XFFF5F5F5),
            child: IconButton(
              onPressed: () {},
              icon: Icon(Icons.chat_bubble, color: Color(0XFFF2AB58)),
            ),
          ),
        ],
      ),
      Divider(),
      SizedBox(height: 8),
      Text(
        'Your location',
        style: TextStyle(
          fontSize: 12,
          color: Color(0XFF878787),
          fontWeight: FontWeight.w500,
        ),
      ),
      Row(
        children: [
          Icon(Icons.location_on_outlined, color: Color(0XFF4CAF50)),
          SizedBox(width: 4),
          Expanded(
            child: Text(
              '123 Al-Madina Street, Abdali, Amman, Jordan',
              style: TextStyle(
                fontSize: 12,
                color: Color(0XFF6C7278),
                fontWeight: FontWeight.w600,
              ),
            ),
          ),
        ],
      ),
    ],
  );
}


