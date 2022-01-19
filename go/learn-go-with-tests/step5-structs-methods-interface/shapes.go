package main

import "math"

func Perimeter(rectangle Rectangle) float64 {
    return (rectangle.Width + rectangle.Height) * 2
}

type Rectangle struct {
    Width  float64
    Height float64
}

func (r Rectangle) Area() float64  {
    return r.Width * r.Height
}

type Circle struct {
    Radius float64
}

func (c Circle) Area() float64  {
    return c.Radius * c.Radius * math.Pi
}