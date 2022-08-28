# Doctrine Metadata Driver Benchmark

## php-fpm results

10 minutes performance testing, 1 thread

| Scenario          | Total number of requests | Median  | Min     | 95 percentile |
|-------------------|--------------------------|---------|---------|---------------|
| Annotation Driver | 35044                    | 16.81ms | 13.8ms  | 19.16ms       |
| Attribute Driver  | 106016                   | 5.5ms   | 4.02ms  | 6.64ms        |
| StaticPHPDriver   | 114089                   | 5.08ms  | 3.63ms  | 6.23ms        |
| PHPDriver         | 98042                    | 5.48ms  | 3.76ms  | 7.47ms        |
| Generated Static  | 102124                   | 5.59ms  | 3.7ms   | 7.38ms        |
| Redis Cache       | 36057                    | 16.2ms  | 11.67ms | 19.94ms       |
| APCu Cache        | 38943                    | 15.06ms | 10.83ms | 18.51ms       |

## Test environment

MacBook Pro (16-inch, 2021) Apple M1 Pro
