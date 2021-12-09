package main

import "fmt"

const englishHellowPrefix = "Hello, "

func Hello(name string, language string) string {
	if name == "" {
		name = "World"
	}
	if language == "Spanish" {
		return "Hola, " + name
	}
	return englishHellowPrefix + name
}

func main() {
	fmt.Println(Hello("world", ""))
}
