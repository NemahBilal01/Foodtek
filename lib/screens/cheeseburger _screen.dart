import 'package:firebasewithnotification/providers/cart_provider.dart';
import 'package:firebasewithnotification/screens/cart&history_screen.dart';
import 'package:firebasewithnotification/screens/cart_screen.dart';
import 'package:firebasewithnotification/screens/history_screen.dart';
import 'package:flutter/material.dart';
import 'package:flutter_rating_bar/flutter_rating_bar.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:provider/provider.dart';

class CheeseburgerDetailsScreen extends StatefulWidget {
  const CheeseburgerDetailsScreen({super.key});

  @override
  State<CheeseburgerDetailsScreen> createState() => _CheeseburgerDetailsScreenState();
}

class _CheeseburgerDetailsScreenState extends State<CheeseburgerDetailsScreen> {
  int quantity = 3;
  double spicyLevel = 1.0;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        body: SingleChildScrollView(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Padding(
                padding: const EdgeInsets.only(left: 30, top: 202),
                child: ClipRRect(
                  borderRadius: BorderRadius.circular(10),
                  child: Image.asset(
                    'images/cheese-burger-details.png',
                    width: 370,
                    height: 203,
                    fit: BoxFit.cover,
                  ),
                ),
              ),
              SizedBox(height: 16),

              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 30),
                child: Text(
                  "Cheeseburger Wendy's Burger",
                  style: GoogleFonts.poppins(
                    fontSize: 20,
                    fontWeight: FontWeight.w500,
                    color: Color(0XFF1B1B1B),
                  ),
                ),
              ),
              SizedBox(height: 5),

              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 30),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Row(
                      children: [
                        RatingBarIndicator(
                          rating: 4.5,
                          itemBuilder: (context, index) => Icon(
                            Icons.star,
                            color: Color(0XFFFFC107),
                          ),
                          itemCount: 5,
                          itemSize: 20,
                          direction: Axis.horizontal,
                        ),
                        SizedBox(width: 5),
                        Text(
                          "4.5 (89 reviews)",
                          style: GoogleFonts.poppins(
                            fontSize: 12,
                            color: Color(0XFF838383),
                            fontWeight: FontWeight.w400,
                          ),
                        ),
                      ],
                    ),
                    SizedBox(height: 8),
                    Row(
                      children: [
                        Text(
                          '\$7.99',
                          style: GoogleFonts.poppins(
                            fontSize: 20,
                            fontWeight: FontWeight.w500,
                            color: Color(0XFF1B1B1B),
                          ),
                        ),
                        SizedBox(width: 5),
                        Text(
                          '\$9.5',
                          style: GoogleFonts.poppins(
                            decoration: TextDecoration.lineThrough,
                            color: Color(0XFF838383),
                            fontSize: 16,
                            fontWeight: FontWeight.w400,
                          ),
                        ),
                      ],
                    ),
                  ],
                ),
              ),
            SizedBox(height: 16),

            // مستوى الحرارة والكمية
            Padding(
              padding: const EdgeInsets.symmetric(horizontal: 30),
              child: SizedBox(
                width: 368, // العرض الكلي
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    // مستوى الحرارة
                    SizedBox(
                      width: 169,
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            "Spicy",
                            style: GoogleFonts.poppins(
                              fontSize: 12,
                              fontWeight: FontWeight.w500,
                              color: Color(0XFF838383),
                            ),
                          ),
                          SizedBox(height: 5),
                          SizedBox(
                            height: 39,
                            child: SliderTheme(
                              data: SliderThemeData(
                                trackHeight: 8,
                                trackShape: RoundedRectSliderTrackShape(radius: 10),
                                activeTrackColor: Color(0XFFEF2A39),
                                inactiveTrackColor: Colors.grey,
                                thumbShape: RoundSliderThumbShape(enabledThumbRadius: 12),
                                thumbColor: Color(0XFFEF2A39),
                                overlayColor: Color(0XFFEF2A39).withOpacity(0.3),
                                overlayShape: RoundSliderOverlayShape(overlayRadius: 20),
                                showValueIndicator: ShowValueIndicator.never,
                              ),
                              child: Slider(
                                value: spicyLevel,
                                min: 1.0,
                                max: 5.0,
                                divisions: 4,
                                onChanged: (newValue) {
                                  setState(() {
                                    spicyLevel = newValue;
                                  });
                                },
                              ),
                            ),
                          ),
                          Row(
                            mainAxisAlignment: MainAxisAlignment.spaceBetween,
                            children: [
                              Text(
                                "Mild",
                                style: GoogleFonts.poppins(
                                  fontSize: 12,
                                  color: Color(0XFF1CC019),
                                  fontWeight: FontWeight.w500,
                                ),
                              ),
                              Text(
                                "Hot",
                                style: GoogleFonts.poppins(
                                  fontSize: 12,
                                  color: Color(0XFFEF2A39),
                                  fontWeight: FontWeight.w500,
                                ),
                              ),
                            ],
                          ),
                        ],
                      ),
                    ),

                    // الكمية
                    SizedBox(
                      width: 115,
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            "Quantity",
                            style: GoogleFonts.poppins(
                              fontSize: 12,
                              fontWeight: FontWeight.w500,
                              color: Color(0XFF838383),
                            ),
                          ),
                          SizedBox(height: 5),
                          Row(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: [
                              IconButton(
                                onPressed: () {
                                  if (quantity > 1) {
                                    setState(() {
                                      quantity--;
                                    });
                                  }
                                },
                                icon: Icon(Icons.remove_circle, color: Color(0XFF25AE4B)),
                              ),
                              Text(
                                quantity.toString(),
                                style: GoogleFonts.poppins(
                                  fontSize: 20,
                                  fontWeight: FontWeight.w500,
                                  color: Colors.black,
                                ),
                              ),
                              IconButton(
                                onPressed: () {
                                  setState(() {
                                    quantity++;
                                  });
                                },
                                icon: Icon(Icons.add_circle, color: Color(0XFF25AE4B)),
                              ),
                            ],
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
              ),
            ),
            SizedBox(height: 20),
            // Add to Cart Button
            Padding(
              padding: const EdgeInsets.only(top: 10,left: 24,bottom: 10,right: 24),
              child: ElevatedButton(
                onPressed: () {
                  final cartProvider = Provider.of<CartProvider>(context, listen: false);

                  cartProvider.addToCart({
                    'name': 'Chicken Burger',
                    'price': 20,
                    'image': 'images/Chicken Burger.png',
                  });

                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (context) => CartAndHistoryScreen()),
                  );
                },
                style: ElevatedButton.styleFrom(
                  backgroundColor: Color(0XFF25AE4B),
                  shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
                  minimumSize: Size(330, 48),
                ),
                child: Text(
                  "Add To Cart",
                  style: GoogleFonts.poppins(color: Colors.white, fontSize: 14,fontWeight: FontWeight.w500),
                ),
              ),
            ),
            SizedBox(height: 20),
          ],
        ),



    ));}
}
class RoundedRectSliderTrackShape extends SliderTrackShape with BaseSliderTrackShape {
  final double radius;

  RoundedRectSliderTrackShape({this.radius = 5.0});

  @override
  Rect getPreferredRect({
    required RenderBox parentBox,
    Offset offset = Offset.zero,
    required SliderThemeData sliderTheme,
    bool isEnabled = false,
    bool isDiscrete = false,
  }) {
    final double trackHeight = sliderTheme.trackHeight ?? 4;
    final double trackLeft = offset.dx;
    final double trackTop = offset.dy + (parentBox.size.height - trackHeight) / 2;
    final double trackWidth = parentBox.size.width;
    return Rect.fromLTWH(trackLeft, trackTop, trackWidth, trackHeight);
  }

  @override
  void paint(
      PaintingContext context,
      Offset offset, {
        required RenderBox parentBox,
        required SliderThemeData sliderTheme,
        required Animation<double> enableAnimation,
        required TextDirection textDirection,
        required Offset thumbCenter,
        Offset? secondaryOffset,
        bool isDiscrete = false,
        bool isEnabled = false,
      }) {
    if (sliderTheme.trackHeight == null || sliderTheme.trackHeight! <= 0) {
      return;
    }

    final Rect trackRect = getPreferredRect(
      parentBox: parentBox,
      offset: offset,
      sliderTheme: sliderTheme,
      isEnabled: isEnabled,
      isDiscrete: isDiscrete,
    );

    final Paint activePaint = Paint()
      ..color = sliderTheme.activeTrackColor ?? Colors.blue
      ..style = PaintingStyle.fill;

    final Paint inactivePaint = Paint()
      ..color = sliderTheme.inactiveTrackColor ?? Colors.grey
      ..style = PaintingStyle.fill;

    final double trackLeft = trackRect.left;
    final double trackTop = trackRect.top;
    final double trackWidth = trackRect.width;
    final double trackHeight = trackRect.height;

    final double thumbPosition = thumbCenter.dx;

    // Draw the inactive track (right side of the thumb)
    final Rect inactiveTrackRect = Rect.fromLTWH(
      thumbPosition,
      trackTop,
      trackLeft + trackWidth - thumbPosition,
      trackHeight,
    );
    context.canvas.drawRRect(
      RRect.fromRectAndRadius(inactiveTrackRect, Radius.circular(radius)),
      inactivePaint,
    );

    // Draw the active track (left side of the thumb)
    final Rect activeTrackRect = Rect.fromLTWH(
      trackLeft,
      trackTop,
      thumbPosition - trackLeft,
      trackHeight,
    );
    context.canvas.drawRRect(
      RRect.fromRectAndRadius(activeTrackRect, Radius.circular(radius)),
      activePaint,
    );
  }
}