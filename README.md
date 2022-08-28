# Doctrine Metadata Driver Benchmark

## php-fpm results

1 minute performance testing, 1 thread

| Scenario          | Total number of requests | Median  | Min     | 95 percentile |
|-------------------|--------------------------|---------|---------|---------------|
| Annotation Driver | 3152                     | 17ms    | 13.38ms | 28.05ms       |
| Attribute Driver  | 10092                    | 5.62ms  | 4.15ms  | 6.24ms        |
| StaticPHPDriver   | 11845                    | 4.83ms  | 3.72ms  | 6.41ms        |
| PHPDriver         | 10689                    | 5.14ms  | 3.67ms  | 7.49ms        |
| Generated Static  | 9935                     | 5.77ms  | 4.04ms  | 7.41ms        |
| Redis Cache       | 3381                     | 16.34ms | 12.1ms  | 24.75ms       |
| APCu Cache        | 3514                     | 16.91ms | 11.23ms | 19.72ms       |

1 minute performance testing, 5 threads

| Scenario          | Total number of requests | Median  | Min     | 95 percentile |
|-------------------|--------------------------|---------|---------|---------------|
| Annotation Driver | 8923                     | 32.25ms | 14.78ms | 52.89ms       |
| Attribute Driver  | 26368                    | 10.51ms | 4.67ms  | 18.58ms       |
| StaticPHPDriver   | 27975                    | 10.02ms | 4.12ms  | 17.3ms        |
| PHPDriver         | 28141                    | 9.93ms  | 4.15ms  | 17.32ms       |
| Generated Static  | 24807                    | 11.1ms  | 4.45ms  | 20.09ms       |
| Redis Cache       | 10506                    | 27.64ms | 16.04ms | 38.45ms       |
| APCu Cache        | 11396                    | 16.91ms | 11.23ms | 19.72ms       |

## Test environment

MacBook Pro (16-inch, 2021) Apple M1 Pro
