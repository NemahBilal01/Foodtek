import 'package:flutter/material.dart';

class FilterScreen extends StatefulWidget {
  const FilterScreen({super.key});

  @override
  State<FilterScreen> createState() => _FilterScreenState();
}

class _FilterScreenState extends State<FilterScreen> {
  double minprice = 0;
  double maxprice = 10;
  double discountMin = 0; // القيمة الدنيا للخصم
  double discountMax = 50; // القيمة القصوى للخصم

  List<bool> selectedCategories = [false, true, false];
  List<bool> selectedLocation = [false, true, false];
  List<bool> selectedDishes = [false, true, false, false, false, false];
  final TextEditingController _minPriceController = TextEditingController();
  final TextEditingController _maxPriceController = TextEditingController();
  final TextEditingController _discountMinController = TextEditingController();
  final TextEditingController _discountMaxController = TextEditingController();

  void initState() {
    super.initState();

    _minPriceController.text = minprice.toStringAsFixed(0);
    _maxPriceController.text = maxprice.toStringAsFixed(0);
    _discountMinController.text = discountMin.toStringAsFixed(0);
    _discountMaxController.text = discountMax.toStringAsFixed(0);
  }

  @override
  void dispose() {

    _minPriceController.dispose();
    _maxPriceController.dispose();
    _discountMinController.dispose();
    _discountMaxController.dispose();
    super.dispose();
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Padding(
        padding: EdgeInsets.all(16),
        child: SingleChildScrollView(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              const Text(
                "Filter",
                style: TextStyle(
                  fontSize: 20,
                  color: Color(0XFF391713),
                  fontWeight: FontWeight.w600,
                ),
              ),
              const SizedBox(height: 10),
              Row(
                children: [
                  Expanded(
                    child: TextFormField(
                      controller: _minPriceController,
                      decoration: InputDecoration(
                        hintText: "Min",
                        border: OutlineInputBorder(
                          borderSide: BorderSide(
                            color:Color(0XFFEAFAEB) ,

                          ),
                          borderRadius: BorderRadius.circular(1.0),
                        ),
                      ),
                      keyboardType: TextInputType.number,
                      onChanged: (value) {
                        setState(() {
                          minprice = double.tryParse(value) ?? minprice;
                        });
                      },
                    ),
                  ),
                  const SizedBox(width: 10),
                  Expanded(
                    child: TextFormField(
                      controller: _maxPriceController,
                      decoration: InputDecoration(
                        hintText: "Max",
                        border: OutlineInputBorder(
                          borderSide: BorderSide(
                            color:Color(0XFFEAFAEB) ,

                          ),
                          borderRadius: BorderRadius.circular(1.0),
                        ),
                      ),
                      keyboardType: TextInputType.number,
                      onChanged: (value) {
                        setState(() {
                          maxprice = double.tryParse(value) ?? maxprice;
                        });
                      },
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 10),

              SliderTheme(
                data: SliderThemeData(
                  trackHeight: 4, // ارتفاع المسار
                  activeTrackColor: Color(0XFF25AE4B), // لون المسار النشط
                  inactiveTrackColor: Colors.grey[300], // لون المسار غير النشط
                  thumbColor: Color(0XFF25AE4B), // لون المؤشر
                  thumbShape: RoundSliderThumbShape(enabledThumbRadius: 12), // شكل المؤشر
                ),
                child: RangeSlider(
                  values: RangeValues(minprice, maxprice),
                  min: 0,
                  max: 10,
                  onChanged: (values) {
                    setState(() {
                      minprice = values.start;
                      maxprice = values.end;
                      _minPriceController.text = minprice.toStringAsFixed(0);
                      _maxPriceController.text = maxprice.toStringAsFixed(0);
                    });
                  },
                ),
              ),



    const Text(
    "Discount",
    style: TextStyle(
    fontSize: 18,
    fontWeight: FontWeight.w600,
    color: Color(0XFF391713),
    ),
    ),
    const SizedBox(height: 10),


    Row(
    children: [
    Expanded(
    child: TextFormField(
    controller: _discountMinController,
    decoration:  InputDecoration(
    hintText: "Min",
    border: OutlineInputBorder(
      borderSide: BorderSide(
        color:Color(0XFFEAFAEB) ,

      ),
      borderRadius: BorderRadius.circular(1.0),
    ),

    ),
    keyboardType: TextInputType.number,
    onChanged: (value) {
    setState(() {
    discountMin = double.tryParse(value) ?? discountMin;
    });
    },
    ),
    ),
    const SizedBox(width: 10),
    Expanded(
    child: TextFormField(
    controller: _discountMaxController,
    decoration:  InputDecoration(
    hintText: "Max",
    border: OutlineInputBorder(
      borderSide: BorderSide(
        color:Color(0XFFEAFAEB) ,

      ),
      borderRadius:BorderRadius.circular(1.0) ,
    ),
    ),
    keyboardType: TextInputType.number,
    onChanged: (value) {
    setState(() {
    discountMax = double.tryParse(value) ?? discountMax;
    });
    },
    ),
    ),
    ],
    ),
    const SizedBox(height: 10),

    // شريط التمرير للخصم
    SliderTheme(
    data: SliderThemeData(
    trackHeight: 4,
    activeTrackColor: Color(0XFF25AE4B), // لون المسار النشط
    inactiveTrackColor: Colors.grey[300], // لون المسار غير النشط
    thumbColor: Color(0XFF25AE4B), // لون المؤشر
    thumbShape: RoundSliderThumbShape(enabledThumbRadius: 12), // شكل المؤشر
    ),
    child: RangeSlider(
    values: RangeValues(discountMin, discountMax),
    min: 0,
    max: 50,
    onChanged: (values) {
    setState(() {
    discountMin = values.start;
    discountMax = values.end;
    _discountMinController.text = discountMin.toStringAsFixed(0);
    _discountMaxController.text = discountMax.toStringAsFixed(0);
    });
    },
    ),
    ),


              // استخدام ToggleButtonsWidget كفئة
              ToggleButtonsWidget(
                title: "Category",
                labels: ["Fast Food", "Sea Food", "Dessert"],
                isSelected: selectedCategories,
              ),
              ToggleButtonsWidget(
                title: "Location",
                labels: ["1 KM", "5 KM", "10 KM"],
                isSelected: selectedLocation,
              ),
              ToggleButtonsWidget(
                title: "Dish",
                labels: [
                  "Tuna Tartare",
                  "Spicy Crab Cakes",
                  "Seafood Paella",
                  "Clam Chowder",
                  "Miso-Glazed Cod",
                  "Lobster Thermidor"
                ],
                isSelected: selectedDishes,
              ),
            ],
          ),
        ),
      ),
    );
  }
}

Widget buildSlider(String title, double min, double max, Function(double, double) onChanged, double start, double end) {
  // تأكد من أن القيم ضمن النطاق الصحيح
  start = start.clamp(min, max);
  end = end.clamp(min, max);

  return Column(
    crossAxisAlignment: CrossAxisAlignment.start,
    children: [
      Text(
        title,
        style: TextStyle(
          fontSize: 14,
          fontWeight: FontWeight.w600,
          color: Color(0XFF98A0B4),
        ),
      ),
      Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Text("\$${min.toStringAsFixed(0)}"),
          Text("\$${max.toStringAsFixed(0)}"),
        ],
      ),
      SliderTheme(
        data: SliderThemeData(
          trackHeight: 3,
          thumbShape: const RoundSliderThumbShape(enabledThumbRadius: 30),
        ),
        child: RangeSlider(
          values: RangeValues(start, end),
          min: min,
          max: max,
          onChanged: (values) {
            // تأكد من أن القيم المحدثة ضمن النطاق الصحيح
            final newStart = values.start.clamp(min, max);
            final newEnd = values.end.clamp(min, max);
            onChanged(newStart, newEnd);
          },
        ),
      ),
    ],
  );
}

class ToggleButtonsWidget extends StatefulWidget {
  final String title;
  final List<String> labels;
  final List<bool> isSelected;

  const ToggleButtonsWidget({
    Key? key,
    required this.title,
    required this.labels,
    required this.isSelected,
  }) : super(key: key);

  @override
  _ToggleButtonsWidgetState createState() => _ToggleButtonsWidgetState();
}

class _ToggleButtonsWidgetState extends State<ToggleButtonsWidget> {
  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const SizedBox(height: 10),
        Text(
          widget.title,
          style: TextStyle(
            fontSize: 14,
            fontWeight: FontWeight.w600,
            color: Color(0XFF98A0B4),
          ),
        ),
        const SizedBox(height: 5),
        Wrap(
          spacing: 5,
          runSpacing: 10,
          children: List.generate(widget.labels.length, (index) {
            return ChoiceChip(
              label: Text(widget.labels[index]),
              selected: widget.isSelected[index],
              selectedColor: Color(0XFF25AE4B),
              onSelected: (selected) {
                setState(() {
                  widget.isSelected[index] = selected;
                });
              },
            );
          }).toList(),
        ),
      ],
    );
  }
}