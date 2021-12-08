package main

import "fmt"

const englishHellowPrefix = "Hello, "

func Hello(name string) string {
	return englishHellowPrefix + name
}

func main() {
	fmt.Println(Hello("world"))
}
