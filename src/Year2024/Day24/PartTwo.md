# 2024 / 24 / Part 2

I have no algorithm for this. I've done this by hand:

- sort the wires by output and filter for the z** outputs
- each z** must be calculated by an XOR
- match the x** and y** to the z** values
- sort the rest wires between the corresponding x**, y** and z** wires
- swap the wires so that each output z** structure is the same
