<?php

$baseCurrency = strtolower(readline("Enter base currency: "));
$conversionCurrency = strtolower(readline("Enter conversion currency: "));
$baseAmount = (float)readline("Enter amount: ");
$currencyRatesApiUrl = "https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/$baseCurrency.json";

$response = file_get_contents($currencyRatesApiUrl);
if ($response === false) {
    exit("Error fetching data");
}

$currencyRatesData = json_decode($response, true);
if ($currencyRatesData == false || isset($currencyRatesData[$baseCurrency]) == false) {
    exit("Invalid base currency");
}

$rates = $currencyRatesData[$baseCurrency];
if (isset($rates[$conversionCurrency]) == false) {
    exit("Conversion currency not available");
}

$rate = $rates[$conversionCurrency];
if ($rate == false) {
    echo "Invalid currency code or conversion rate not available";
} else {
    $convertedAmount = $baseAmount * $rate;
    echo strtoupper($baseCurrency) . " " . number_format($baseAmount, 2)
        . " = " . strtoupper($conversionCurrency) . " " . number_format($convertedAmount,2) . "\n";
}
