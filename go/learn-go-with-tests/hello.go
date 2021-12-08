package main

import "fmt"

const englishHellowPrefix = "Hello, "

func Hello(name string) string {
	if name == "" {
		name = "World"
	}
	return englishHellowPrefix + name
}

func main() {
	fmt.Println(Hello("world"))
}
