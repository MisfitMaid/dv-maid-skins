echo "Optimizing png's..."
Get-ChildItem -Recurse -Filter *.png | Foreach-Object -Parallel {
  optipng -quiet $_.FullName
  echo "$_ optimized"
} -ThrottleLimit 8
