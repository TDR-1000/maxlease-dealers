/*----------------------------------------------------*/
/*  config: AutoNumeric voor formulieren
/*----------------------------------------------------*/

// aantal jaren
const jarenElement = AutoNumeric.multiple('input.jaren', {
		showWarnings: false,
		allowDecimalPadding: false,
    currencySymbol: " jaar",
    currencySymbolPlacement: "s",
    decimalCharacter: ",",
    decimalPlaces: 1,
    emptyInputBehavior: "null",
    decimalPlacesShownOnBlur: 0,
    digitGroupSeparator: ".",
    maximumValue: "80",
		unformatOnSubmit: true,
    minimumValue: "0"
});

// aantal maanden
const maandenElement = AutoNumeric.multiple('input.maanden', {
		showWarnings: false,
		allowDecimalPadding: false,
    currencySymbol: " maanden",
    currencySymbolPlacement: "s",
    decimalCharacter: ",",
    decimalPlaces: 1,
    emptyInputBehavior: "null",
    decimalPlacesShownOnBlur: 0,
    digitGroupSeparator: ".",
    maximumValue: "80",
    minimumValue: "0"
});

// aantal weken
const wekenElement = AutoNumeric.multiple('input.weken', {
		showWarnings: false,
		allowDecimalPadding: false,
    currencySymbol: " weken",
    currencySymbolPlacement: "s",
    decimalCharacter: ",",
    decimalPlaces: 1,
    emptyInputBehavior: "null",
    decimalPlacesShownOnBlur: 0,
    digitGroupSeparator: ".",
    maximumValue: "80",
    minimumValue: "0"
});

// aantal euro's (posten incl opmaak)
const euroElement =  AutoNumeric.multiple('input.euro', {
		currencySymbol: "€ ",
		showWarnings: false,
		decimalPlaces: 0,
		decimalCharacter: ",",
		digitGroupSeparator: ".",
		emptyInputBehavior: "null",
		maximumValue: "10000000",
		minimumValue: "0",
		outputFormat: "string",
		unformatOnSubmit: false,
		modifyValueOnWheel: false,
		selectNumberOnly: false
});

// aantal euro's (posten als getal)
const eurorawElement =  AutoNumeric.multiple('input.euroraw', {
		currencySymbol: "€ ",
		showWarnings: false,
		decimalPlaces: 0,
		decimalCharacter: ",",
		digitGroupSeparator: ".",
		emptyInputBehavior: "null",
		maximumValue: "10000000",
		minimumValue: "0",
		outputFormat: "string",
		unformatOnSubmit: true,
		modifyValueOnWheel: false,
		selectNumberOnly: false
});

// aantal euro's per maand
const europmElement =  AutoNumeric.multiple('input.europm', {
    currencySymbol: "€ ",
    showWarnings: false,
    decimalCharacter: ",",
    digitGroupSeparator: ".",
    emptyInputBehavior: "null",
    maximumValue: "1000000",
    minimumValue: "0",
    outputFormat: "string",
		suffixText: " p/maand",
		unformatOnSubmit: true,
		modifyValueOnWheel: false,
    selectNumberOnly: true
});

// aantal euro's (minimaal 5000 euro)
const eurokrElement =  AutoNumeric.multiple('input.eurokr', {
    currencySymbol: "€ ",
    decimalCharacter: ",",
		decimalPlaces: 2,
    digitGroupSeparator: ".",
		emptyInputBehavior: "null",
    caretPositionOnFocus: "end",
    formatOnPageLoad: true,
    maximumValue: "1000000",
		minimumValue: "0",
		unformatOnSubmit: true,
		modifyValueOnWheel: false,
		outputFormat: "number"
});

// aantal kg's
const kgElement =  AutoNumeric.multiple('input.kg', {
		showWarnings: false,
		allowDecimalPadding: false,
    currencySymbol: " kg",
    currencySymbolPlacement: "s",
    decimalCharacter: ",",
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator: ".",
    emptyInputBehavior: "null",
    maximumValue: "100000",
    minimumValue: "0",
    outputFormat: "string"
});

// aantal cm's
const cmElement =  AutoNumeric.multiple('input.cm', {
		showWarnings: false,
		allowDecimalPadding: false,
    currencySymbol: " cm",
    currencySymbolPlacement: "s",
    decimalCharacter: ",",
    decimalPlacesShownOnFocus: 0,
    digitGroupSeparator: ".",
    emptyInputBehavior: "null",
    maximumValue: "50000",
    minimumValue: "0",
    outputFormat: "string"
});

// km stand
const kmstandElement =  AutoNumeric.multiple('input.kmstand', {
		showWarnings: false,
		allowDecimalPadding: false,
    decimalCharacter: ",",
		leadingZero: "keep",
    emptyInputBehavior: "null"
});

// meldcode
const meldcodeElement =  AutoNumeric.multiple('input.meldcode', {
    allowDecimalPadding: false,
    digitGroupSeparator: "",
    emptyInputBehavior: "null",
    leadingZero: "keep",
		minimumValue: "0000",
    maximumValue: "9999",
		modifyValueOnWheel: false,
		showWarnings: false
});

// kvknummer
const kvknrElement =  AutoNumeric.multiple('input.kvknr', {
    allowDecimalPadding: false,
    digitGroupSeparator: "",
    emptyInputBehavior: "null",
    leadingZero: "keep",
		minimumValue: "00000000",
    maximumValue: "99999999",
		modifyValueOnWheel: false,
		showWarnings: false
});
